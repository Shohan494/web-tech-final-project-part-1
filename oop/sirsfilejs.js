function isValid(pForm) {
	
	if (pForm.email.value === "") {
		document.getElementById("email_msg").innerHTML = "Please fill up the email";
	}
	if (pForm.password.value === "") {
		document.getElementById("password_msg").innerHTML = "Please fill up the password";
	}
	else {
		const regx = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})/;
		if (! regx.test(pForm.password.value)) {
			document.getElementById("password_msg").innerHTML = "Please fill up the password requirements";
		}
	}
	return false;
}