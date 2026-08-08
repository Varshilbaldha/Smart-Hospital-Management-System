<?php

// require_once "../includes/config.php";

// /* If already logged in */

// if (isset($_SESSION['patient']))
// {
//     header("Location: dashboard.php");
//     exit();
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Patient Login</title>

    <link rel="stylesheet" href="login.css">

</head>

<body>

<div class="login-container">

    <div class="login-card">

        <h2>Patient Login</h2>

        <p>
            Login using your Email Address or Mobile Number.
        </p>

        <form
            action="login_process.php"
            method="POST">

            <div>

                <label>

                    Email / Mobile :

                </label>

                <input

                    type="text"

                    name="login_id"

                    required

                    placeholder="Email or Mobile Number"

                >

            </div>

            <br>

            <div>

                <label>

                    Password :

                </label>

                <input

                    type="password"

                    name="password"

                    required

                    placeholder="Enter Password"

                >

            </div>

            <br>

            <div>

                <label>

                    <input
                        type="checkbox"
                        name="remember_me">

                    Remember Me

                </label>

            </div>

            <br>

            <button
                type="submit">

                Login

            </button>

        </form>

        <br>

        <a href="forgot_password.php">

            Forgot Password?

        </a>

        <br><br>

        <a href="register.php">

            Create New Account

        </a>

    </div>

</div>

</body>

</html>