<?php

  if (isset($_GET['token'])) {

    $token = $_GET['token'];

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

<form action="ForgotPasswordReestController.php" method="post">
  <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
  <label for="password">New Password:</label>
  <input type="password" name="password" required>
  <button type="submit" name="reset_password_submit">Reset Password</button>
</form>
