<?php

include '../DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->getConnection();

session_start();

$user_id = $_SESSION['logged_in_user']['id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = sanitize($_POST['email']);

    if (empty($email)) {

        $messages[] = "Please fill up the email properly";
        $_SESSION['messages'] = $messages;
    
        header("Location: ../View/forgot-password.php");    }
    else{

        $sql = "SELECT * FROM users WHERE email='$email'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            $token = bin2hex(random_bytes(32));

            $sql = "UPDATE users SET token='$token' WHERE email='$email'";

            // do a query and sent an email with token generating a link

            // will be created a token and then sent to email

            // check your email

            if (mysqli_query($conn, $sql)) {
            
                $messages[] = "Email does exist! An Email has been/will be sent to your account for password reset link.";

                $messages[] = 'Click the link below to reset your password:';
                
                $messages[] = "<a href=http://localhost/webTechMidProject/mvc-oop/View/reset-password.php?token=$token" . ">Link for Passowrd Reset</a>";

                $_SESSION['messages'] = $messages;
            
                header("Location: ../View/forgot-password.php");
                exit;
              } else {
                $messages[] = "Error : " . mysqli_error($conn);
                $_SESSION['messages'] = $messages;
            
                header("Location: ../View/forgot-password.php");
              }

        } else {

            $messages[] = "Email doesn't exist!";
            $_SESSION['messages'] = $messages;
        
            header("Location: ../View/forgot-password.php");               
        }
    }
}

function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
