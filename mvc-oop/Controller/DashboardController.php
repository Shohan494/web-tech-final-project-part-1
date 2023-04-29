<?php

include '../DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->getConnection();

$user_id = $_SESSION['logged_in_user']['id'];
$user_role = $_SESSION['logged_in_user']['role'];

$sql = "SELECT * FROM users WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$user_details = (mysqli_fetch_assoc($result));



?>