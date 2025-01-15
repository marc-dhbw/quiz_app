<?php
// If user is logged in, forward to dashboard.php
if (isset($_SESSION['user'])) {
    header('location: dashboard.php', true, 301);
    exit;
}
// If user is not logged in, forward to login.php
header('location: login.php', true, 301);
exit;