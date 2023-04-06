<?php

class DatabaseConnection {
  private $host = 'localhost';
  private $username = 'root';
  private $password = '';
  private $dbname = 'webtech';
  private $conn;

  public function __construct() {
    $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
    else{
      echo("Connection Done!");
    }
  }

  public function getConnection() {
    return $this->conn;
  }
}

// Usage:
$db = new DatabaseConnection();
$conn = $db->getConnection();

// Perform queries using $conn


