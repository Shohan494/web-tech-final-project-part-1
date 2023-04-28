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

if(isset($_GET['order_id']) && !empty($_GET['order_id'])) {
  $order_id = $_GET['order_id'];

  $sql = "SELECT p.name, od.quantity, od.price, od.subtotal
          FROM order_details AS od
          INNER JOIN products AS p
          ON od.product_id = p.product_id
          WHERE od.order_id = '$order_id'";

  $result = mysqli_query($conn, $sql);
  $order_details = array();
  $total_cost = 0;
  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $order_details[] = $row;
      $total_cost += $row['subtotal'];
    }
  }
} else {
  header("Location: orders.php");
  exit;
}
?>

<h1>Order Details</h1>

<h2>Order ID: <?php echo $order_id; ?></h2>

<h3>Products:</h3>

<table border="1">
  <thead>
    <tr>
      <th>Product Name</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Subtotal</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($order_details as $product): ?>
      <tr>
        <td><?php echo $product['name']; ?></td>
        <td><?php echo $product['quantity']; ?></td>
        <td><?php echo $product['price']; ?></td>
        <td><?php echo $product['subtotal']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="3" style="text-align:right">Total:</td>
      <td><?php echo $total_cost; ?></td>
    </tr>
  </tfoot>
</table>

<br>

<a href="orders-management.php">Back to Orders List</a>

<?php
include_once "footer.php";
?>
