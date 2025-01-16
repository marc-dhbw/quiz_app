<?php
require_once '../init.php';

if (!isset($_SESSION['user'])) {
    header('location: login.php',true, 301);
    exit;
}

$pageTitle = 'Questions';
include 'templates/header.php';

// Set parameters for pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // current page
$limit = 10; // results per page
$offset = ($page - 1) * $limit; // calculate offset for next page

// Take connection from pool
$connectionPool = getConnectionPool();
$connection = $connectionPool->getConnection();

// Query database with limit and offset
$stmt = $connection->prepare('SELECT * FROM questions LIMIT :limit OFFSET :offset');
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

// Fetch results per page at once
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<h2>Questions</h2>';
foreach ($results as $row) {
    echo '<p>' . htmlspecialchars($row['question_text']) . '</p>';
}

// Get total of records
$totalStmt = $connection->query('SELECT COUNT(*) FROM questions');
$totalRows = $totalStmt->fetchColumn();
$totalPages = ceil($totalRows / $limit);

// Show navigation (pages) ausgeben
for ($i = 1; $i <= $totalPages; $i++) {
    echo '<a href="?page=' . $i . '">Seite ' . $i . '</a> ';
}

// Release connection back to the pool
$connectionPool->releaseConnection($connection);
?>
    <p>Back to main page</p>
    <a href="dashboard.php"><button>Dashboard</button></a>
<?php
include 'templates/footer.php';
