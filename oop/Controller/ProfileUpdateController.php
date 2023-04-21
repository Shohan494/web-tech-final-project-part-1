<?php

include '../DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->getConnection();

session_start();

$user_id = $_SESSION['logged_in_user']['id'];


if(isset($_POST['update_profile'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];

    $sql = "UPDATE users SET email='$email', username='$username' WHERE id='$user_id'";

    if(mysqli_query($conn, $sql)) {

        // PASS SESSION MESSAGE FOR USER UPDATE

        $messages[] = "Profile Updated!";
        $_SESSION['messages'] = $messages;

        header("Location: ../View/dashboard.php");
        exit;
      } else {
        $error = "Error updating user: " . mysqli_error($conn);
      }



}
