<?php
session_start();

include '../DatabaseConnection.php';
$db = new DatabaseConnection();
$conn = $db->getConnection();

  $user_id = $_POST['user_id'];

  echo json_encode(['status' => 'success', 'message' => $user_id]);

  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");

  $stmt->bind_param("i", $user_id);

  if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
  } else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
  }

  $stmt->close();
  $conn->close();
?>
