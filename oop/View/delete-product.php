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


// check if user is authorized to access this page (e.g. check user role)
if($_SESSION['logged_in_user']['role'] !== 'admin') {
  header("Location: unauthorized.php");
  exit;
}

// check if ID parameter is present in URL
if(!isset($_GET['id'])) {
  header("Location: products-management.php");
  exit;
}

$id = $_GET['id'];
$messages = array();

// delete user from database
$sql = "DELETE FROM products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
header("Location: products-management.php");
exit;
} else {
$messages[] = "Error deleting product: " . $stmt->error;
$_SESSION['messages'] = $messages;
header("Location: products-management.php");
}
$stmt->close();
$conn->close();

?>
<!DOCTYPE html>
<html>
<head>
  <title>Delete Product</title>
</head>
<body>
<?php if(isset($error)): ?>
  <p><?php echo $error; ?></p>
<?php endif; ?>
<?php

include 'footer.php';

?>