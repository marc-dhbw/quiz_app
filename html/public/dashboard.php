<?php
session_start();

// If user is not logged in, forward to login.php
if (!isset($_SESSION['user'])) {
    header('location: login.php',true, 301);
    exit;
}

$pageTitle = 'Dashboard';
include 'templates/header.php';

// If user is logged in, greet him per name
echo '<h2>Welcome, ' . htmlspecialchars($_SESSION['user']) . '</h2>';
?>
    <main>

    <p>Show the best players</p>
    <a href="leaderboard.php"><button>Leaderboard</button></a>
    <p>Show the question list</p>
    <a href="questions.php"><button>Questions</button></a>
    <p>Show the question list with pagination</p>
    <a href="questions_pagination.php"><button>Questions with pagination</button></a>


    <p>See you next time!</p>
    <a href="logout.php"><button>Logout</button></a>
    </main>
<?php
include 'templates/footer.php';
?>
