<?php
session_start();

$user_details = $_SESSION['logged_in_user'];
$user_role = $_SESSION['logged_in_user']['role'];

include '../DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->getConnection();

if ($user_role !== 'admin' && $user_role !== 'salesman') {
    header("Location: unauthorized.php");
    exit;
  }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    print_r($_POST['quantity']);

    $errors = array();
    foreach ($_POST['quantity'] as $key => $value) {
        $quantity = $_POST['quantity'][$key];
        if (!is_numeric($quantity) || $quantity <= 0) {
            $errors[] = "Invalid quantity for product " . $key;
        }
    }

    //If there are errors, display them and redirect back to the form

    // if (!empty($errors)) {
    //     $_SESSION['errors'] = $errors;
    //     header('Location: place-order.php');
    //     exit;
    // }

    // If the input is valid, insert the order and order details records
    $customer_id = $_POST['customer_id'];
    $order_date = date('Y-m-d H:i:s');
    $total_cost = 0;

    print_r($order_date);

    // Insert the order record
    $sql = "INSERT INTO orders (customer_id, order_date, total_cost) VALUES ('$customer_id', '$order_date', '$total_cost')";
    if (mysqli_query($conn, $sql)) {
        $order_id = mysqli_insert_id($conn);
    } else {
        $_SESSION['error'] = "Error inserting order: " . mysqli_error($conn);
        header('Location: place-order.php');
        exit;
    }

    // Insert the order details records
    foreach ($_POST['quantity'] as $key => $value) {

        if ($_POST['quantity'][$key] != 0) {

            $product_id = $_POST['product_id'][$key];

            $quantity = $_POST['quantity'][$key];

            $price = $_POST['price'][$key];

            $subtotal = $quantity * $price;

            $total_cost += $subtotal;

            $sql = "INSERT INTO order_details (order_id, product_id, quantity, price, subtotal) VALUES ('$order_id', '$product_id', '$quantity', '$price', '$subtotal')";

            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    $sql = "UPDATE orders SET total_cost = '$total_cost' WHERE order_id = '$order_id'";
    mysqli_query($conn, $sql);

    $messages[] = "New Order Created";
    $_SESSION['messages'] = $messages;

    header("Location: orders-management.php");
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php if (isset($_SESSION['errors'])) : ?>
        <?php foreach ($_SESSION['errors'] as $error) : ?>
            <center>
                <p><?php echo $error; ?></p>
            </center>
        <?php endforeach; ?>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

</body>

</html>