function isValid(pForm) {
	let isValid = true;
  
	if (pForm.username.value === "") {
	  document.getElementById("username_msg").innerHTML = "Please fill up the username";
	  isValid = false;
	}
	if (pForm.email.value === "") {
	  document.getElementById("email_msg").innerHTML = "Please fill up the email";
	  isValid = false;
	}
	if (pForm.password.value === "") {
	  document.getElementById("password_msg").innerHTML = "Please fill up the password";
	  isValid = false;
	}
	if (pForm.confirm_password.value === "") {
	  document.getElementById("confirm_password_msg").innerHTML = "Please fill up the confirm password";
	  isValid = false;
	} else {
	  const regx = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})/;
	  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
	  if (!regx.test(pForm.password.value)) {
		document.getElementById("password_msg").innerHTML = "Please fill up the password requirements: it should contain at least one lowercase letter, at least one uppercase letter, at least one number, and at least one special character. It should also have a minimum length of 8 characters.";
		isValid = false;
	  }
  
	  if (!emailRegex.test(pForm.email.value)) {
		document.getElementById("email_msg").innerHTML = "Please fill up with valid email";
		isValid = false;
	  }
	}
  
	return isValid;
  }
  





// function isValid(pForm) {
	
// 	if (pForm.username.value === "") {
// 		document.getElementById("username_msg").innerHTML = "Please fill up the username";
// 	}
// 	if (pForm.email.value === "") {
// 		document.getElementById("email_msg").innerHTML = "Please fill up the email";
// 	}
// 	if (pForm.password.value === "") {
// 		document.getElementById("password_msg").innerHTML = "Please fill up the password";
// 	}
// 	if (pForm.confirm_password.value === "") {
// 		document.getElementById("confirm_password_msg").innerHTML = "Please fill up the confirm password";
// 	}
// 	else {
// 		const regx = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})/;
// 		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

// 		if (! regx.test(pForm.password.value)) {
// 			document.getElementById("password_msg").innerHTML = "Please fill up the password requirements: it should contain at least one lowercase letter, at least one uppercase letter, at least one number, and at least one special character. It should also have a minimum length of 8 characters.";
// 		}

// 		if (! emailRegex.test(pForm.email.value)) {
// 			document.getElementById("email_msg").innerHTML = "Please fill up with valid email";
// 		}
// 	}
	
// 	return false;
// }
