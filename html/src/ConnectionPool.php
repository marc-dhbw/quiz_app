<?php
class ConnectionPool {
    // Singleton so that ConnectionPool can be instantiated only once
    private static $instance = null;
    // Pool for connections
    private $pool = [];
    // Maximum number of available connections
    private $maxConnections = 5;
    private $host;
    private $user;
    private $password;
    private $dbname;

    // Private constructor --> class can only be instantiated internally
    private function __construct($host, $user, $password, $dbname) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    // Method to get / create the singleton instance
    public static function getInstance($host, $user, $password, $dbname) {
        if (self::$instance === null) {
            self::$instance = new ConnectionPool($host, $user, $password, $dbname);
        }
        return self::$instance;
    }

    // Method to get a connection from the pool
    public function getConnection() {
        if (count($this->pool) > 0) {
            // Take connection
            return array_pop($this->pool);
        }

        // If pool is empty create new connection
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e) {
            die("Verbindung fehlgeschlagen: " . $e->getMessage());
        }
    }

    // Release connection back to the pool
    public function releaseConnection($connection) {
        if (count($this->pool) < $this->maxConnections) {
            $this->pool[] = $connection;
        } else {
            // Close connection if pool is already full
            $connection->close();
        }
    }

    // Optional: Clear pool and close all connections
    public function closeAllConnections() {
        foreach ($this->pool as $connection) {
            $connection->close();
        }
        $this->pool = [];
    }
}
