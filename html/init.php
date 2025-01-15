<?php
session_start();
require_once 'src/ConnectionPool.php';
// Create the Connection Pool
function getConnectionPool() {
    static $connectionPool = null;
    if ($connectionPool === null) {
        $connectionPool = ConnectionPool::getInstance('mariadb', 'user', 'password', 'quiz_db');
    }
    return $connectionPool;
}