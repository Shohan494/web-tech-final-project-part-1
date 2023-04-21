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

// check if user is authorized to access this page (e.g. check user role)
if($_SESSION['logged_in_user']['role'] !== 'admin') {
  header("Location: unauthorized.php");
  exit;
}

$user_email = $_SESSION['logged_in_user']['username'];

// if role admin
// customer, salesman crud

$user_role = $_SESSION['logged_in_user']['role'];

// retrieve user data from database
// you would replace this with your own database code

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$users = array();
if(mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
  }
}
?>


<h1>Users Management</h1>

<?php if(isset($_SESSION['messages'])): ?>
      <?php foreach($_SESSION['messages'] as $message): ?>
        <center><p><?php echo $message; ?></p></center>
      <?php endforeach; ?>
      <?php unset($_SESSION['messages']); ?>
    <?php endif; ?>

<a href="add-user-form.php">Add User</a>



<br>

<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Edit User
      </th>
      <th>Delete User</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users as $user): ?>
      <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['username']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['role']; ?></td>
        <td>
          <button><a href="edit-user.php?id=<?php echo $user['id']; ?>">Edit</a></button>
        </td>
        <td>
        <button><a href="delete-user.php?id=<?php echo $user['id']; ?>">Delete</a></button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

