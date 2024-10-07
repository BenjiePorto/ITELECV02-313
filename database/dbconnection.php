<?php

class Database {
    private $host; 
    private $db_name;
    private $username;
    private $password;
    public $conn;
    private $port;

    public function __construct() {
        if (
            $_SERVER["SERVER_NAME"] === "localhost" || 
            $_SERVER["SERVER_ADDR"] === "127.0.0.1" || 
            $_SERVER["SERVER_ADDR"] === "192.168.1.72"
        ) {
            // Local environment settings
            $this->host = "localhost";
            $this->db_name = "itelec2";
            $this->username = "root";
            $this->password = "";
            $this->port = '3307';
        } else {
            // Production environment settings
            $this->host = "localhost";
            $this->db_name = "itelec2";
            $this->username = "root";
            $this->password = "";
            $this->port = '3306';  // Assume default port for production
        }
    }

    public function dbConnection() {
        $this->conn = null;
        try {
            // Create DSN string with charset
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4"; // Use utf8mb4 for extended characters
            
            // Append port if it's defined and not the default
            if (isset($this->port) && !empty($this->port)) {
                $dsn .= ";port={$this->port}";
            }

            $this->conn = new PDO($dsn, $this->username, $this->password);
            // Enable exception handling
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        } catch (PDOException $exception) {
            // Log the connection error
            error_log("Connection error: " . $exception->getMessage());
            // Optionally rethrow the exception or handle it as per your application's requirement
        }
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null; // Close the connection
    }
}

?>
