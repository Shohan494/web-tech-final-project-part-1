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

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
  
    if(empty($productName) || empty($productPrice)) {
      $error = "Please fill in all fields.";
    } else {
        $sql = "INSERT INTO products (name, price) VALUES ('$productName', '$productPrice')";
        if(mysqli_query($conn, $sql)) {
          header("Location: products-management.php");
          exit;
        } else {
          $error = "Error adding product: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
  
?>

<h1>Products Management</h1>

    <?php if (isset($error_msg)) { ?>
        <p style="color: red;"><?php echo $error_msg; ?></p>
    <?php } ?>

    <form action="add-product-form.php" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required><br><br>

        <!-- <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description" required></textarea><br><br> -->

        <label for="product_price">Product Price:</label>
        <input type="number" step="0.01" min="0" id="product_price" name="product_price" required><br><br>

        <input type="submit" value="Add Product">
    </form>
    <?php


?>