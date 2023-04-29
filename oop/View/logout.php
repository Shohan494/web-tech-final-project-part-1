<?php
session_start();

$_SESSION = array();

session_destroy();

setcookie('auto_logout', '', time() - 3600, '/');

header("Location: ../View/login.php");
exit;
?>
