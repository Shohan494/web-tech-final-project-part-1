<?php
session_start();

$user_details = $_SESSION['logged_in_user'];
$user_role = $_SESSION['logged_in_user']['role'];

?>

<?php
    include_once "header.php";
?>



<?php

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

<h2>BUTTON CAN EITHER BE CALLED VIA JS OR BUTTON/LIONK CSS SHOULD BE DIFFERENT, CURRENT LOOK IS UNPROFESSIONAL</h2>

<?php if(isset($_SESSION['messages'])): ?>
      <?php foreach($_SESSION['messages'] as $message): ?>
        <center><p><?php echo $message; ?></p></center>
      <?php endforeach; ?>
      <?php unset($_SESSION['messages']); ?>
    <?php endif; ?>



<button class="btn btn-success" name="login_attempt"><a href="add-user-form.php">Add User</a></button>



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

