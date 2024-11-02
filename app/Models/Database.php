<?php
namespace App\Models;

use PDO; // No need for use here; use it directly with global namespace
use PDOException;

class Database {
    private static $instance = null;
    private $conn;
    private $host = 'localhost';
    private $db = 'cake_project'; // Make sure this database exists
    private $user = 'root'; // Your database username
    private $pass = ''; // Your database password

    private function __construct() {
        try {
            // Create a new PDO connection
            $this->conn = new \PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
            // Set the PDO error mode to exception
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn; // Return the PDO connection
    }
}
