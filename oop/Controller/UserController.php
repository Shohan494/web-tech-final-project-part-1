<?php

include '../DatabaseConnection.php';

class UserController {

  public function getUserByToken($token) {

    $db = new DatabaseConnection();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT * FROM users WHERE token = ?");
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
}