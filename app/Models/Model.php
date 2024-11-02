<?php
namespace App\Models;
use PDO; // Use the global PDO class
use PDOException;


class Model {
    protected $db;
    protected $table;

    public function __construct($table) {
        $this->db = Database::getInstance()->getConnection();
        // Initialize the Database connection
        // Assuming there's a Database class for connection
        $this->table = $table;       // The table name to perform operations on
    }

    // CREATE: Insert a new record
    public function create($data) {
        // Extract the keys from the data array
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
        $stmt=$this->db->prepare($sql);

        // Bind the data
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Execute the query
        return $stmt->execute();
    }

    public function fetchAll() {

        $stmt = $this->db->query("SELECT * FROM $this->table");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    
    // READ: Fetch all records or a specific record by ID
    public function get($id = null) {
        if ($id) {
            $table_id = rtrim($this->table,'s');
            $table_id = $table_id."_id";
            $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE $table_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();  // Fetch a single record
        } else {
            return $this->db->query("SELECT * FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);  // Fetch all records
        }
    }

    // UPDATE: Update a record by ID
    public function update($id, $data) {
        // Prepare SQL with column placeholders for each field
        $table_id = rtrim($this->table,'s');
        $table_id = $table_id."_id";
        $setString = '';
        foreach ($data as $key => $value) {
            $setString .= "$key = :$key, ";
        }
        $setString = rtrim($setString, ', ');

        $sql = "UPDATE $this->table SET $setString WHERE $table_id = :id";
        // echo $sql;
        $stmt=$this->db->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Bind data
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        // Execute query
        return $stmt->execute();    }

    // DELETE: Delete a record by ID
    public function delete($id) {
        var_dump($id);
        $table_id = rtrim($this->table,'s');
        $table_id .="_id";
        $stmt = $this->db->prepare("DELETE FROM $this->table WHERE $table_id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Optional: Search by a specific field
    public function findBy($column, $value) {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE $column = :value");
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
}

