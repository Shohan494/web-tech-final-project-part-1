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


if($_SESSION['logged_in_user']['role'] !== 'admin') {
  header("Location: unauthorized.php");
  exit;
}

$user_email = $_SESSION['logged_in_user']['username'];

// if role admin
// customer, salesman crud

$user_role = $_SESSION['logged_in_user']['role'];

$messages = array();

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

  
      $messages[] = "New User Created";
      $_SESSION['messages'] = $messages;

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
  <br>
  <label for="role">Role</label>
  <select name="role" id="role">
    <option value="customer">Customer</option>
    <option value="salesman">Salesman</option>
    <option value="admin">Admin</option>
  </select>
  <br>
  <br>
  <button type="submit">Add User</button>
</form>
<a href="dashboard.php"><button>Back to Dashboard</button></a>


<?php

include 'footer.php';

?>