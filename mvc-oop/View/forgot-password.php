<?php

session_start();
include_once "header.php";

?>

<body>
<center><img src="../Assets/oil-station.png" alt="" class="logo-image"></center>
    <center>
        <h2>Fuel Distribution Forgot Password</h2>
    </center>

<?php if(isset($_SESSION['messages'])): ?>
  <?php foreach($_SESSION['messages'] as $message): ?>
    <center><p><?php echo $message; ?></p></center>
  <?php endforeach; ?>
  <?php unset($_SESSION['messages']); ?>
<?php endif; ?>

	<div align="center">

		<form method="post" action="../Controller/ForgotPasswordController.php">
			<table>
				<tr>
					<td>
						<fieldset>
							<legend><b>Forgot Password Form:</b></legend>
							<table>
								<tr>
									<th>
										<label for="email">Email</label>
									</th>
									<td>:</td>
									<td>
										<input type="email" name="email" id="email">
									</td>
								</tr>

								<tr>
									<th></th>
									<td></td>
									<td align="right">
                                    <button class="btn btn-success" name="login_attempt">Submit</button>
									</td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
			</table>
		</form>

		<p>For Registration as Customer, Click <a href="registration.php">here</a>.</p>
		<p>Already have account, Login <a href="login.php">here</a>.</p>
	</div>


<?php

include 'footer.php';

?>