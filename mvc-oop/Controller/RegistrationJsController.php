<?php
session_start();

include '../DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->getConnection();

// check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // get form inputs
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $usernamedata, $emaildata, $passworddata, $roledata);

    // set parameters and execute
    $usernamedata = $username;
    $emaildata = $email;
    $passworddata = $password;
    $roledata = "customer";

    $messages = array();

    if ($stmt->execute()) {

      $messages[] = "Registration Suceess! You can now Login";

      $_SESSION['messages'] = $messages;

      header("Location: ../View/login.php");
      exit;
    } else {
      $messages[] = "Error adding user: " . mysqli_error($conn);
    }

  // store errors in session
  $_SESSION['messages'] = $messages;

  // redirect back to form
  header("Location: ../View/registration.php");
  exit;
}
