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