<?php
session_start();

$user_details = $_SESSION['logged_in_user'];
$user_role = $_SESSION['logged_in_user']['role'];

?>

<?php
    include_once "header.php";
    include_once "navigation-menu.php";

    include '../DatabaseConnection.php';
    $db = new DatabaseConnection();
    $conn = $db->getConnection();


    if ($user_role !== 'admin' && $user_role !== 'salesman') {
      header("Location: unauthorized.php");
      exit;
    }
    
  


if(empty($_GET['customer_id'])) {

  $messages[] = "Please select customer for creating order";
  $_SESSION['messages'] = $messages;

  header("Location: customers-list.php");
  exit;
}



$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<h1>Have to check only Admin/Salesman can have the access</h1>

<form method="post" action="place-order.php">
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($products as $product): ?>
        <tr>
          <td><?php echo $product['product_id']; ?></td>

          <input type="hidden" name="product_id[<?php echo $product['product_id']; ?>]" value="<?php echo $product['product_id']; ?>">
          
          <input type="hidden" name="price[<?php echo $product['product_id']; ?>]" value="<?php echo $product['price']; ?>">

          <input type="hidden" name="customer_id" value="<?php echo $_GET['customer_id']; ?>">


          <td><?php echo $product['name']; ?></td>
          <td><?php echo $product['description']; ?></td>
          <td><?php echo $product['price']; ?></td>
          <td>
            <input type="number" name="quantity[<?php echo $product['product_id']; ?>]" min="0" value="0">
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <br>

  <button type="submit">Place Order</button>


</form>

<a href="customers-list.php"><button>Back to Customer Select</button></a>
