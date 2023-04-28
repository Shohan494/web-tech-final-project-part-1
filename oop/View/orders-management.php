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

if($_SESSION['logged_in_user']['role'] !== 'admin') {
  header("Location: unauthorized.php");
  exit;
}

$user_email = $_SESSION['logged_in_user']['username'];

$user_role = $_SESSION['logged_in_user']['role'];

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

<h2>Order Details Should Be Added</h2>

<a href="create-order.php">Create New Order</a>


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
      <th>Edit Product
      </th>
      <th>Delete Product</th>
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
          <center><button><a href="order-details.php?order_id=<?php echo $order['order_id']; ?>">View Order Details</a></button></center>
        </td>
      
        <td>
          <button><a href="edit-product.php?id=<?php echo $order['product_id']; ?>">Edit</a></button>
        </td>
        <td>
          <button><a href="delete-product.php?id=<?php echo $order['product_id']; ?>">Delete</a></button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>










