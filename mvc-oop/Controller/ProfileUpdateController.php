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

  $sql = "UPDATE users SET email=?, username=? WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssi", $email, $username, $user_id);

  if ($stmt->execute()) {

    $result = $stmt->get_result();
    $messages[] = "Profile Updated!";




    $_SESSION['logged_in_user'] = mysqli_fetch_assoc($result);
    $_SESSION['messages'] = $messages;

    header("Location: ../View/dashboard.php");

  } else {

    $messages[] = "Error updating user: " . $stmt->error;
    $_SESSION['messages'] = $messages;

    header("Location: ../View/dashboard.php");
  }
}


$sql = "SELECT * FROM users WHERE username=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();
$_SESSION['logged_in_user'] = mysqli_fetch_assoc($result);