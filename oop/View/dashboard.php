<?php
session_start();

$user_details = $_SESSION['logged_in_user'];
$user_role = $_SESSION['logged_in_user']['role'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

legend {
  font-size: 20px;
  font-weight: bold;
}

label {
  display: inline-block;
  width: 120px;
  text-align: right;
  margin-right: 20px;
}

input[type=text], input[type=password] {
  width: 200px;
  padding: 6px 10px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
}

button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 4px;
}

.btn-success {
  background-color: #5cb85c;
}

.btn-success:hover {
  background-color: #449d44;
}
    </style>

</head>
<body>

<ul>
  <li><a href="dashboard.php">Dashboard</a></li>

<!-- A DIRECT PAGE SHOULD HAVE A CONTROLLER LINK BY DEFAULT THEN THE 
CONTROLLERS DEFAULT METHOD WILL REDIRECT TO VIEW -->
  
  <?php if($user_role == 'admin'): ?>
    <li><a href="users-management.php">Users Management</a></li>
    <li><a href="products-management.php">Products Management</a></li>

    <?php elseif($user_role == 'customer'): ?>

  <a href='previous_transactions.php'>See previous transactions and order details</a><br>
  <a href='current_order_status.php'>View the status of your current order</a><br>
  <a href='contact_sales_team.php'>Contact the sales team with questions or concerns</a><br>
  <a href='update_payment_method.php'>Update your payment method and other information</a><br>
  <a href='transaction_statistics.php'>View your transaction statistics</a><br>
  <a href='new_order_request.php'>Request a new order</a><br>

  <?php endif; ?>
  
  <li><a href="logout.php">Logout</a></li>
</ul>


<?php if(isset($_SESSION['messages'])): ?>
      <?php foreach($_SESSION['messages'] as $message): ?>
        <center><p><?php echo $message; ?></p></center>
      <?php endforeach; ?>
      <?php unset($_SESSION['messages']); ?>
<?php endif; ?>

<fieldset>
    <legend>Profile Update:</legend>
<form method="post" action="../Controller/ProfileUpdateController.php">

          <div class="form-group">
          <div class="row"> 
            <div class="col-3">
                <label>Email</label>
            </div>
             <div class="col">
                <input type="text" name="email" value="<?php echo $user_details['email'];?>" class="form-control">
            </div>
          </div>
      </div>
      <div class="form-group">
 <div class="row"> 
            <div class="col-3">
                <label>Username</label>
            </div>
             <div class="col">
                <input type="text" name="username" value="<?php echo $user_details['username'];?>" class="form-control">
            </div>
          </div>
      </div>
           <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
              <br>
<button  class="btn btn-success" name="update_profile">Save Profile</button>
            </div>
           </div>
       </form>  
</fieldset>

<br>

<fieldset>
    <legend>Password Change:</legend>


    

<form method="POST" action="PasswordChangeController.php">
  <label for="old_password">Old Password:</label>
  <input type="password" id="old_password" name="old_password" required><br>

  <label for="new_password">New Password:</label>
  <input type="password" id="new_password" name="new_password" required><br>

  <label for="confirm_password">Confirm Password:</label>
  <input type="password" id="confirm_password" name="confirm_password" required><br>

  <br>

  <input type="submit" name="change_password" value="Change Password">
</form>

</fieldset>






