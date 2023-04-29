<?php
// Start session
session_start();

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "webtech");

// Get form inputs
$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user into database
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
if (mysqli_query($conn, $sql)) {
	// Redirect to login page
	header("Location: login.php");
	exit();
} else {
	// Show error message
	$_SESSION['error'] = "Error creating user: " . mysqli_error($conn);
	header("Location: register.php");
	exit();
}

// Close database connection
mysqli_close($conn);
?>
