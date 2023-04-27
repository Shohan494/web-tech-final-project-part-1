<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      /* reset default margin and padding */
      * {
        margin: 0;
        padding: 0;
      }

      /* basic page layout */
      body {
        font-family: Arial, sans-serif;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
      }

      h1 {
        font-size: 2em;
        margin-bottom: 20px;
      }

      h2 {
        font-size: 1.5em;
        margin-bottom: 10px;
      }

      table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
      }

      th,
      td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
      }

      th {
        background-color: #f2f2f2;
      }

      /* add some color */
      h1,
      h2 {
        color: #333;
      }

      table {
        background-color: #fff;
      }

      th,
      td {
        background-color: #f9f9f9;
      }

      /* button styles */
      button {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
      }

      /* button hover effect */
      button:hover {
        background-color: #3e8e41;
      }
    </style>
</head>
<body>



<?php

session_start();

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


<a href="add-product-form.php">Add Product</a>

<br>

<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Date</th>
      <th>Customer Email</th>
      <th>Total Cost</th>
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
          <button><a href="edit-product.php?id=<?php echo $order['product_id']; ?>">Edit</a></button>
        </td>
        <td>
          <button><a href="delete-product.php?id=<?php echo $order['product_id']; ?>">Delete</a></button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>







    
</body>
</html>



