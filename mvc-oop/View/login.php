<?php
session_start();

include_once "header.php";

?>
    <center><img src="../Assets/oil-station.png" alt="" class="logo-image"></center>
    <center>
        <h2>Fuel Distribution Login</h2>
    </center>

    <?php if (isset($_SESSION['messages'])) : ?>
        <?php foreach ($_SESSION['messages'] as $message) : ?>
            <center>
                <p><?php echo $message; ?></p>
            </center>
        <?php endforeach; ?>
        <?php unset($_SESSION['messages']); ?>
    <?php endif; ?>

    <div align="center">
        <form method="post" action="../Controller/LoginController.php">
            <table>
                <tr>
                    <td>
                        <fieldset>
                            <legend><b>Login Form:</b></legend>
                            <table>
                                <tr>
                                    <th>
                                        <label for="username">Username</label>
                                    </th>
                                    <td>:</td>
                                    <td>
                                        <input type="text" name="username" id="username">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="password">Password</label>
                                    </th>
                                    <td>:</td>
                                    <td>
                                        <input type="password" name="password" id="password">
                                    </td>

                                    <input type="hidden" name="secret" value="password">
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                    <td align="right">
                                        <button class="btn btn-success" name="login_attempt">Login</button>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </form>

        <p>For Registration as Customer (PHP Validation), Click <a href="registration.php">here</a>.</p>

        <p>For Registration as Customer (JS Validation), Click <a href="registration-js.php">here</a>.</p>

        <p>Forgot your password, try <a href="forgot-password.php">here</a>.</p>
    </div>



<?php
    include_once "footer.php";
?>