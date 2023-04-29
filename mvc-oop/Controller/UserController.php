<?php

include '../DatabaseConnection.php';

class UserController {


  private $conn;

  public function __construct() {
    $db = new DatabaseConnection();
    $this->conn = $db->getConnection();
  }


  public function getUserByToken($token) {

    $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
      $user = $result->fetch_assoc();
      return $user;
    } else {
      return null;
    }
  }

  public function updatePassword($userId, $newPassword) {

    $valueOfNull = null;
  
    $stmt = $this->conn->prepare("UPDATE users SET password=?, token=? WHERE id = ?");
    $stmt->bind_param("ssi", $newPassword, $valueOfNull, $userId);
    $stmt->execute();
  
    if ($stmt->affected_rows == 1) {
      return true;
    } else {
      return false;
    }
  }
  
}