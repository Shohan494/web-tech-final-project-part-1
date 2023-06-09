<?php

session_start();

include '../DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->getConnection();


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $flag = true;

    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);

    if (empty($username) || empty($password)) {

        $messages[] = "Please fill up the username/password properly";
        $flag = false;
    }
    else{
        $sql = "SELECT * FROM users WHERE username=? AND password=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $flag = true;
        } else {
            $messages[] = "Username password mismatch or not found!";
            $flag = false;
        }
    }

    if ($flag === true) {

        $messages[] = "Successfully Logged In!";

        // USE SESSION TO PASS USER DETAILs

        $_SESSION['logged_in_user'] = mysqli_fetch_assoc($result);   

        $_SESSION['messages'] = $messages;

        $cookie_expiration_time = time() + 60;

        setcookie("user_login", $_SESSION['logged_in_user']['username'], $cookie_expiration_time, '/');

        // print_r($_SESSION['logged_in_user']);

        // print_r(time());
        // echo "<br>";
        // print_r(time() + 60);
        // echo "<br>";

        // print_r($_COOKIE['user_login']);
        // echo "<br>";
        // print_r($_SESSION['logged_in_user']['username']);


        header("Location: ../View/dashboard.php");

        
    } else
    {
        $_SESSION['messages'] = $messages;
        header("Location: ../View/login.php");
    }
}

function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>