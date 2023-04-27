<?php
session_start();

$user_details = $_SESSION['logged_in_user'];
$user_role = $_SESSION['logged_in_user']['role'];

?>

<?php
    include_once "header.php";
?>



  <?php if (isset($_SESSION['messages'])) : ?>
    <?php foreach ($_SESSION['messages'] as $message) : ?>
      <center>
        <p><?php echo $message; ?></p>
      </center>
    <?php endforeach; ?>
    <?php unset($_SESSION['messages']); ?>
  <?php endif; ?>

  <fieldset>
    <legend>Profile Update:</legend>

    <h1>DURING PROFILE UPDATE HAVE TO MAKE SURE EVEN FROM HERE NO DUPLICATE ENTRY TAKES PLACE AND PROPER ERROR MESSAGE IS SHOWED</h1>

    <form method="post" action="../Controller/ProfileUpdateController.php">

      <label for="email">Email</label>
      <input type="text" name="email" value="<?php echo $user_details['email']; ?>" class="form-control">
      <br>

      <label>Username</label>
      <input type="text" name="username" value="<?php echo $user_details['username']; ?>" class="form-control">
      <br>

      <button class="btn btn-success" name="update_profile">Save Profile</button>

    </form>
  </fieldset>

  <br>

  <fieldset>
    <legend>Password Change:</legend>

    <h1>OLD PASSOWRD FIELD IS ON FORM, BUT WHAT IS THE USE OF THIS FIELD HERE?</h1>

    <form method="POST" action="PasswordChangeController.php">
      <label for="old_password">Old Password:</label>
      <input type="password" id="old_password" name="old_password" required><br>

      <label for="new_password">New Password:</label>
      <input type="password" id="new_password" name="new_password" required><br>

      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" required><br>

      <br>

      <button class="btn btn-success" name="change_password">Change Password</button>
    </form>

  </fieldset>