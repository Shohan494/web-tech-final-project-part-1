<?php

include '../DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->getConnection();

session_start();

$user_id = $_SESSION['logged_in_user']['id'];


if (isset($_POST['update_profile'])) {
  $email = $_POST['email'];
  $username = $_POST['username'];

  $sql = "UPDATE users SET email='$email', username='$username' WHERE id='$user_id'";


  if (mysqli_query($conn, $sql)) {

    $result = mysqli_query($conn, $sql);

    $messages[] = "Profile Updated!";

    $_SESSION['messages'] = $messages;

    // again query after update

    $sql = "SELECT * FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $_SESSION['logged_in_user'] = mysqli_fetch_assoc($result); 

    header("Location: ../View/dashboard.php");

  } else {

    $messages[] = "Error updating user: " . mysqli_error($conn);
    $_SESSION['messages'] = $messages;

    header("Location: ../View/dashboard.php");
  }
}
