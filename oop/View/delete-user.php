<?php
session_start();

include '../DatabaseConnection.php';
$db = new DatabaseConnection();
$conn = $db->getConnection();

  // Get user ID from the request
  $user_id = $_POST['user_id'];

  echo json_encode(['status' => 'success', 'message' => $user_id]);

  // Prepare the SQL statement
  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");

  // Bind the user ID parameter to the statement
  $stmt->bind_param("i", $user_id);

  // Execute the statement
  if ($stmt->execute()) {
    // If the statement executed successfully, send a success message back to the client
    echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
  } else {
    // If the statement failed to execute, send an error message back to the client
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
  }

  // Close the database connection
  $stmt->close();
  $conn->close();
?>
