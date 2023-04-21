<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      /* reset default margin and padding */
      * {
        margin: 0;
        padding: 0;
      }

      /* basic page layout */
      body {
        font-family: Arial, sans-serif;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
      }

      h1 {
        font-size: 2em;
        margin-bottom: 20px;
      }

      h2 {
        font-size: 1.5em;
        margin-bottom: 10px;
      }

      table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
      }

      th,
      td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
      }

      th {
        background-color: #f2f2f2;
      }

      /* add some color */
      h1,
      h2 {
        color: #333;
      }

      table {
        background-color: #fff;
      }

      th,
      td {
        background-color: #f9f9f9;
      }

      /* button styles */
      button {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
      }

      /* button hover effect */
      button:hover {
        background-color: #3e8e41;
      }
    </style>
</head>
<body>


<?php

session_start();

include '../DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->getConnection();


if($_SESSION['logged_in_user']['role'] !== 'admin') {
  header("Location: unauthorized.php");
  exit;
}

$user_email = $_SESSION['logged_in_user']['username'];

// if role admin
// customer, salesman crud

$user_role = $_SESSION['logged_in_user']['role'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  if(empty($name) || empty($email) || empty($password) || empty($role)) {
    $error = "Please fill in all fields.";
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email address.";
  } else {
    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    if(mysqli_query($conn, $sql)) {
      header("Location: users-management.php");
      exit;
    } else {
      $error = "Error adding user: " . mysqli_error($conn);
    }
    mysqli_close($conn);
  }
}

?>


<h1>Add User</h1>

<?php if(isset($error)): ?>
  <p><?php echo $error; ?></p>
<?php endif; ?>

<form action="add-user-form.php" method="post">
  <label for="name">Name</label>
  <input type="text" name="name" id="name">
  <br>
  <label for="email">Email</label>
  <input type="email" name="email" id="email">
  <br>
  <label for="password">Password</label>
  <input type="password" name="password" id="password">
  <br>
  <label for="role">Role</label>
  <select name="role" id="role">
    <option value="customer">Customer</option>
    <option value="salesman">Salesman</option>
    <option value="admin">Admin</option>
  </select>
  <br>
  <button type="submit">Add User</button>
</form>
