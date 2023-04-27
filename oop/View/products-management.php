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

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
$products = array();
if(mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
  }
}
?>

<h1>Products Management</h1>

<h2>[ WOULD BE BETTER TO ADD QUANTITY AND BASIC CALCULATION  FOR EACH ORDER ]</h2>

<a href="add-product-form.php">Add Product</a>

<br>

<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Description</th>
      <th>Price</th>
      <th>Edit Product
      </th>
      <th>Delete Product</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($products as $product): ?>
      <tr>
        <td><?php echo $product['product_id']; ?></td>
        <td><?php echo $product['name']; ?></td>
        <td><?php echo $product['description']; ?></td>
        <td><?php echo $product['price']; ?></td>
        <td>
          <button><a href="edit-product.php?id=<?php echo $product['product_id']; ?>">Edit</a></button>
        </td>
        <td>
          <button><a href="delete-product.php?id=<?php echo $product['product_id']; ?>">Delete</a></button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>







    
</body>
</html>



