<?php
session_start();

include_once "header.php";

?>

<h1>Reset Password Form</h1>



<form action="../Controller/ForgotPasswordReestController.php" method="post">
  <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
  <label for="password">New Password:</label>
  <input type="password" name="password" required>

  <br>
  <button type="submit" name="reset_password_submit">Reset Password</button>
</form>



<?php

include 'footer.php';

?>
