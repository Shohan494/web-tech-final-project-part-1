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

  // basic form validation
  $messages = array();

  if (empty($username)) {
    $messages[] = "Username is required.";
  }
  if (empty($email)) {
    $messages[] = "Email is required.";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $messages[] = "Email is invalid.";
  }
  if (empty($password)) {
    $messages[] = "Password is required.";
  }
  if (strlen($password) < 6) {
    $messages[] = "Password must be at least 6 characters long.";
  }
  if ($password !== $confirm_password) {
    $messages[] = "Password and confirm password must match.";
  }

  // if there are no errors
  if (empty($messages)) {

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $usernamedata, $emaildata, $passworddata, $roledata);

    // set parameters and execute
    $usernamedata = $username;
    $emaildata = $email;
    $passworddata = $password;
    $roledata = "customer";

    if ($stmt->execute()) {

      $messages[] = "Registration Suceess! You can now Login";

      $_SESSION['messages'] = $messages;

      header("Location: login.php");
      exit;
    } else {
      $errors[] = "Error adding user: " . mysqli_error($conn);
    }
  }

  // store errors in session
  $_SESSION['messages'] = $messages;

  // redirect back to form
  header("Location: ../View/registration.php");
  exit;
}

?>