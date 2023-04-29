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

if(isset($_GET['order_id']) && !empty($_GET['order_id'])) {
  $order_id = $_GET['order_id'];

  $sql = "SELECT p.name, od.quantity, od.price, od.subtotal
          FROM order_details AS od
          INNER JOIN products AS p
          ON od.product_id = p.product_id
          WHERE od.order_id = '$order_id'";

$sql = "SELECT p.name, od.quantity, od.price, od.subtotal, u.email, o.order_date
FROM order_details AS od
INNER JOIN products AS p ON od.product_id = p.product_id
INNER JOIN orders AS o ON od.order_id = o.order_id
INNER JOIN users AS u ON o.customer_id = u.id
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

<h2>Customer Email: <?php isset($order_details[0]['email'])? $order_details[0]['email']: ""; ?></h2>

<h3>Products List:</h3>

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
    <?php foreach($order_details as $order_detail): ?>
      <tr>
        <td><?php echo $order_detail['name']; ?></td>
        <td><?php echo $order_detail['quantity']; ?></td>
        <td><?php echo $order_detail['price']; ?></td>
        <td><?php echo $order_detail['subtotal']; ?></td>
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

<a href="orders-management.php"><button>Back to Orders List</button></a>

<?php
include_once "footer.php";
?>
