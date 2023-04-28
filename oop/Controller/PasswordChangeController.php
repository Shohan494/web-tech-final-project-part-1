<?php

include '../DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->getConnection();

session_start(); // start session to store error messages

$current_password = $_SESSION['logged_in_user']['password'];
$current_user_id = $_SESSION['logged_in_user']['id'];


// check if form is submitted
if(isset($_POST['change_password'])) {

  // get form inputs
  $old_password = $_POST['old_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  // basic password validation
  $messages = array();
  if(empty($old_password)) {
    $messages[] = "Old password is required.";
  }
  if(empty($new_password)) {
    $messages[] = "New password is required.";
  }
  if(strlen($new_password) < 8) {
    $messages[] = "New password must be at least 8 characters long.";
  }
  if($new_password !== $confirm_password) {
    $messages[] = "New password and confirm password must match.";
  }

  // if there are no errors
  if(empty($messages)) {
    if($old_password !== $current_password) {
      $messages[] = "Old password is incorrect.";
    } else {
    $sql = "UPDATE users SET password='$new_password' WHERE id='$current_user_id'";
    if(mysqli_query($conn, $sql)) {
      $messages[] = "Password changed successfully.";
      $_SESSION['messages'] = $messages;
      header("Location: ../View/dashboard.php");
      exit;
    } else {
        $messages[] = "Error updating user: " . mysqli_error($conn);
        $_SESSION['messages'] = $messages;
        header("Location: ../View/dashboard.php");
        exit;
    }        
    }
  }

  $_SESSION['messages'] = $messages;
  header("Location: ../View/dashboard.php");
  exit;
}
