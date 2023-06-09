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

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    //var_dump($_POST);

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    
    $update_query = "UPDATE products SET name='$product_name', description='$product_description', price='$product_price' WHERE product_id='$product_id'";

    $result = mysqli_query($conn, $update_query);
    
    if($result){


        $messages[] = "Product Data Updated";
        $_SESSION['messages'] = $messages;
        header('Location: products-management.php');
    } else {
        print_r($conn->error);
        echo "Error updating product";
    }
}

$product_id = $_GET['id'];

$select_query = "SELECT * FROM products WHERE product_id='$product_id'";
$result = mysqli_query($conn, $select_query);
$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
        <label>Product Name:</label>
        <input type="text" name="product_name" value="<?php echo $product['name']; ?>"><br><br>
        <label>Product Description:</label>
        <textarea name="product_description"><?php echo $product['description']; ?></textarea><br><br>
        <label>Product Price:</label>
        <input type="number" name="product_price" step="any" value="<?php echo $product['price']; ?>"><br><br>

        <button type="submit">Update Product</button>    
    </form>
    <?php

include 'footer.php';

?>