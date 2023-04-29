<?php

$to = "shohan5917@gmail.com";
$subject = "Test email";
$message = "Hello, this is a test email.";
$headers = "From: sender@example.com\r\n" .
           "Reply-To: sender@example.com\r\n" .
           "X-Mailer: PHP/" . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully";
} else {
    echo "Email could not be sent";
}
