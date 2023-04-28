<?php
session_start();
include '../DatabaseConnection.php';
$db = new DatabaseConnection();
$conn = $db->getConnection();


if(isset($_POST['search'])) {
  $search_term = $_POST['search_term'];
  $query = "SELECT * FROM users WHERE role = 'customer' AND (username LIKE '%$search_term%' OR email LIKE '%$search_term%')";
} else {
  $query = "SELECT * FROM users WHERE role = 'customer'";
}

$result = mysqli_query($conn, $query);

if(!$result) {
  die("Error fetching customers: " . mysqli_error($conn));
}

$customers = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Customer Orders</title>
</head>
<body>
  <h1>Seleect Customer For Order Creation</h1>

  <h2>BETTER TO ADD A JQUERY/JS SEARCH HERE</h2>

  <form action="" method="POST">
    <input type="text" name="search_term" placeholder="Search...">
    <button type="submit" name="search">Search</button>
  </form>

  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Create Order</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($customers as $customer): ?>
        <tr>
          <td><?php echo $customer['id']; ?></td>
          <td><?php echo $customer['username']; ?></td>
          <td><?php echo $customer['email']; ?></td>
          <td><button><a href="create-order.php?customer_id=<?php echo $customer['id']; ?>">Create Order</a></button></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
