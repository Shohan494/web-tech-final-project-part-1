<!-- CONTROLLER THEN METHOD -->


<?php

include '../Controller/UserController.php';


  if (isset($_POST['token'])) {

    $token = $_POST['token'];

    $password = $_POST['password'];

    $userCtrl = new UserController();

    $user = $userCtrl->getUserByToken($token);
    if (!$user) {
      header("Location: reset-password-error.php");
      exit;
    }

    $userCtrl->updatePassword($user['id'], $password);
    header("Location: reset-password-success.php");
    exit;
  }

?>