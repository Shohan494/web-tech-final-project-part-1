<?php
session_start();

// Include database connection file
include_once("connect.php");

// Check if user is logged in
if(!isset($_SESSION["customer_id"])) {
  header("Location: login.php");
  exit();
}

// Get customer ID from session

//$customer_id = $_SESSION["customer_id"];

$customer_id = 1;

// Fetch customer's orders
$sql = "SELECT * FROM orders WHERE customer_id = $customer_id";
$result_orders = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
  <title>My Orders</title>
</head>
<body>
  <h1>My Orders</h1>
  
  <?php
  // Check if customer has any orders
  if(mysqli_num_rows($result_orders) > 0) {
    while($row_orders = mysqli_fetch_assoc($result_orders)) {
      // Display order details
      echo "<h2>Order ID: " . $row_orders["order_id"] . "</h2>";
      echo "<p>Order Date: " . $row_orders["order_date"] . "</p>";
      echo "<p>Status: " . $row_orders["status"] . "</p>";
      
      // Fetch products associated with order
      $order_id = $row_orders["order_id"];
      $sql = "SELECT products.product_id, products.name, products.price, order_products.quantity
              FROM order_products
              INNER JOIN products ON order_products.product_id = products.product_id
              WHERE order_products.order_id = $order_id";
      $result_products = mysqli_query($conn, $sql);
      
      // Display product details
      echo "<table>";
      echo "<tr><th>Product Name</th><th>Price</th><th>Quantity</th></tr>";
      while($row_products = mysqli_fetch_assoc($result_products)) {
        echo "<tr>";
        echo "<td>" . $row_products["name"] . "</td>";
        echo "<td>" . $row_products["price"] . "</td>";
        echo "<td>" . $row_products["quantity"] . "</td>";
        echo "</tr>";
      }
      echo "</table>";
    }
  } else {
    // Display message if customer has no orders
    echo "<p>You have no orders yet.</p>";
  }
  
  // Close database connection
  mysqli_close($conn);
  ?>
  
</body>
</html>