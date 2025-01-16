<?php
require_once '../init.php';

if (!isset($_SESSION['user'])) {
    header('location: login.php',true, 301);
    exit;
}

$pageTitle = 'Leaderboard';
include 'templates/header.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$connectionPool = getConnectionPool();
$connection = $connectionPool->getConnection();

$stmt = $connection->prepare('SELECT * FROM leaderboard ORDER BY score DESC LIMIT :limit OFFSET :offset');
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<h2>Leaderboard</h2>';
foreach ($results as $row) {
    $userStmt = $connection->prepare('SELECT username FROM users WHERE id = :user_id');
    $userStmt->bindValue(':user_id', $row['user_id'], PDO::PARAM_INT);
    $userStmt->execute();
    $user = $userStmt->fetch(PDO::FETCH_ASSOC);

    echo '<p>' . htmlspecialchars($user['username']) . ' - ' . htmlspecialchars($row['score']) . '</p>';
}

$totalStmt = $connection->query('SELECT COUNT(*) FROM leaderboard');
$totalRows = $totalStmt->fetchColumn();
$totalPages = ceil($totalRows / $limit);

for ($i = 1; $i <= $totalPages; $i++) {
    echo '<a href="?page=' . $i . '">Page ' . $i . '</a> ';
}

$connectionPool->releaseConnection($connection);
?>

    <p>Back to main page</p>
    <a href="dashboard.php"><button>Dashboard</button></a>

<?php
include 'templates/footer.php';
?>
