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

// Check if the user is logged in and has admin role
if (!isset($_SESSION['logged_in_user']) || $_SESSION['logged_in_user']['role'] !== 'admin') {
    header("Location: unauthorized.php");
    exit;
}


// Get all the users from the database
$sql = "SELECT id, username, email, role FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>User List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
      // Handle delete button click events
      $('.delete-user').click(function() {
        var user_id = $(this).data('user-id');

        console.log(user_id);

        // Send an AJAX request to delete the user
        $.ajax({
          type: 'POST',
          url: 'delete-user.php',
          data: {user_id: user_id}
        }).done(function(response) {
            $('#user-' + user_id).remove();
        console.log("inside done");
        }).fail(function(xhr, status, error) {
        console.log("Error: " + error);
        });
      });
    });
  </script>
</head>

<body>
    <h1>User List</h1>

    <a href="create-user.php">Create New User</a>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr id="user-<?php echo $user['id']; ?>">
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td><a href="edit-user.php?id=<?php echo $user['id']; ?>">Edit</a></td>
                    <td><button class='delete-user' data-user-id=<?php echo $user["id"]; ?>>Delete</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>