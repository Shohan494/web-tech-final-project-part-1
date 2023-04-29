<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<script src="testformvalidation.js"></script>
</head>
<body>

	<h2>Registration Form</h2>

	<form method="post" action="test-register-process.php" onsubmit="return validateForm()">
		<label for="username">Username:</label>
		<input type="text" name="username" id="username"><br><br>

		<label for="email">Email:</label>
		<input type="email" name="email" id="email"><br><br>

		<label for="password">Password:</label>
		<input type="password" name="password" id="password"><br><br>

		<label for="confirm_password">Confirm Password:</label>
		<input type="password" name="confirm_password" id="confirm_password"><br><br>

		<input type="submit" value="Register">
	</form>

</body>
</html>
