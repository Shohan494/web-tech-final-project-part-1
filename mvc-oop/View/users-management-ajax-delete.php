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

if ($user_role !== 'admin') {
    header("Location: unauthorized.php");
    exit;
  }


$sql = "SELECT id, username, email, role FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
?>

    
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
            document.getElementById("user_deleted_message").innerHTML = "Ajax Call User Deleted";
        console.log("inside done");
        }).fail(function(xhr, status, error) {
        console.log("Error: " + error);
        });
      });
    });
  </script>
</head>

<body>
    <h1>Users Management Ajax Delete</h1>

    <p><span id="user_deleted_message"></span></p>

    <a href="create-user.php"><button>Create New User</button></a>
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
                    <td><a href="edit-user.php?id=<?php echo $user['id']; ?>"><button>Edit</button></a></td>
                    <td><button class='delete-user' data-user-id=<?php echo $user["id"]; ?>>Delete</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>