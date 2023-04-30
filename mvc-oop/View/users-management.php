<?php
session_start();

$user_details = $_SESSION['logged_in_user'];
$user_role = $_SESSION['logged_in_user']['role'];

?>

<?php
include_once "header.php";
include_once "navigation-menu.php";
?>

<?php

include '../DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->getConnection();

// check if user is authorized to access this page (e.g. check user role)
if ($_SESSION['logged_in_user']['role'] !== 'admin') {
  header("Location: unauthorized.php");
  exit;
}

$user_email = $_SESSION['logged_in_user']['username'];
$user_role = $_SESSION['logged_in_user']['role'];



$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$users = array();
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
  }
}
?>


<h1>Users Management</h1>

<?php if (isset($_SESSION['messages'])) : ?>
  <?php foreach ($_SESSION['messages'] as $message) : ?>
    <center>
      <p><?php echo $message; ?></p>
    </center>
  <?php endforeach; ?>
  <?php unset($_SESSION['messages']); ?>
<?php endif; ?>



<a href="add-user-form.php"><button>Create New User</button></a>
<a href="dashboard.php"><button>Back to Dashboard</button></a>


<br>

<br>

<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Email</th>
      <th>Role</th>
      <th>Edit
      </th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user) : ?>
      <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['username']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['role']; ?></td>
        <td>
          <a href="edit-user.php?id=<?php echo $user['id']; ?>"><button>Edit</button></a>
        </td>
        <td>
          <a href="../Controller/DeleteUserController.php?id=<?php echo $user['id']; ?>"><button>Delete</button></a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>