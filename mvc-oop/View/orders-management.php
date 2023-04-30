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

print_r($user_role);


include '../DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->getConnection();

if ($user_role !== 'admin' && $user_role !== 'salesman') {
  header("Location: unauthorized.php");
  exit;
}


$user_email = $_SESSION['logged_in_user']['username'];

$sql = "SELECT o.order_id, o.order_date, o.total_cost, c.email
        FROM orders AS o
        INNER JOIN users AS c
        ON o.customer_id = c.id
        ORDER BY o.order_date DESC";

$result = mysqli_query($conn, $sql);
$orders = array();
if(mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $orders[] = $row;
  }
}
?>

<h1>Orders Management</h1>


<a href="create-order.php"><button class="btn btn-success">Create New Order</button></a>
<a href="dashboard.php"><button class="btn btn-success">Back to Dashboard</button></a>

<br>
<br>

<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Date</th>
      <th>Customer Email</th>
      <th>Total Cost</th>
      <th>View Order Details
      </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($orders as $order): ?>
      <tr>
        <td><?php echo $order['order_id']; ?></td>
        <td><?php echo $order['order_date']; ?></td>
        <td><?php echo $order['email']; ?></td>
        <td><?php echo $order['total_cost']; ?></td>
        <td>
          <center><a href="order-details.php?order_id=<?php echo $order['order_id']; ?>"><button>View Order Details</button></a></center>
        </td>
      

      </tr>
    <?php endforeach; ?>
  </tbody>
</table>










