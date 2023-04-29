<?php
session_start();

include_once "header.php";

?>

<center><img src="../Assets/oil-station.png" alt="" class="logo-image"></center>

<center>
    <h2>Fuel Ditribution Customer Registration</h2>
</center>

<div align="center">
    <!-- registration form -->

    <p><span id="username_msg"></span></p>
    <p><span id="email_msg"></span></p>
    <p><span id="password_msg"></span></p>
    <p><span id="confirm_password_msg"></span></p>

    <?php if (isset($_SESSION['messages'])) : ?>
        <?php foreach ($_SESSION['messages'] as $message) : ?>
            <center>
                <p><?php echo $message; ?></p>
            </center>
        <?php endforeach; ?>
        <?php unset($_SESSION['messages']); ?>
    <?php endif; ?>

    <form method="post" action="../Controller/RegistrationJsController.php" onsubmit="return isValid(this);">
        <table>
            <tr>
                <td>
                    <fieldset>
                        <legend><b>Registration Form:</b></legend>



                        <table>
                            <tr>
                                <td><label for="username">Username:</label></td>
                                <td><input type="text" id="username" name="username"></td>

                            </tr>
                            <tr>
                                <td><label for="email">Email:</label></td>
                                <td><input type="email" id="email" name="email"></td>

                            </tr>
                            <tr>
                                <td><label for="password">Password:</label></td>
                                <td><input type="password" id="password" name="password"></td>

                            </tr>
                            <tr>
                                <td><label for="confirm_password">Confirm Password:</label></td>
                                <td><input type="password" id="confirm_password" name="confirm_password"></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td><button class="btn btn-success" name="registration_attempt">Register As Customer</button></td>
                            </tr>
                        </table>
                    </fieldset>
                </td>
            </tr>
        </table>
    </form>

    <p>Already have an account? Click <a href="login.php">here</a>.</p>
    <p>Forgot your password, try <a href="forgot-password.php">here</a>.</p>
</div>



</div>

<script src="../Assets/js/registration-form-validation.js"></script>

<?php

include 'footer.php';

?>