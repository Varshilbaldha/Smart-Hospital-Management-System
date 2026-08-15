<?php
session_start();
?>
<meta charset="UTF-8">
<!DOCTYPE html>
<html lang="en">
<head>
<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Patient Registration

</title>

<link rel="stylesheet" href="register1.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
</head>
<body>
    <div class="container">

    <div class="register-card">

        <h2>

            Patient Registration

        </h2>

        <p>

            Create your CarePlus Account

        </p>

        <form
    action="patient_registration.php"
    method="POST"
    id="registerForm">

    <!-- CARD 1 -->
    <div class="form-card">

        <div class="input-group">

            <label>
                First Name :
            </label>

            <input
                type="text"
                name="first_name"
                id="first_name">

        </div>

        <div class="input-group">

            <label>
                Last Name :
            </label>

            <input
                type="text"
                name="last_name"
                id="last_name">

        </div>

    </div>


    <!-- CARD 2 -->
    <div class="form-card">

        <div class="input-group">

            <label>
                Mobile Number :
            </label>

            <input
                type="text"
                name="mobile"
                id="mobile">

        </div>

        <div class="input-group">

            <label>
                Email :
            </label>

            <input
                type="email"
                name="email"
                id="email">

        </div>

    </div>


    <!-- CARD 3 -->
    <div class="form-card">

        <div class="input-group">

            <label>
                Password :
            </label>

            <input
                type="password"
                name="password"
                id="password">

        </div>

        <div class="input-group">

            <label>
                Confirm Password :
            </label>

            <input
                type="password"
                name="confirm_password"
                id="confirm_password">

        </div>

    </div>


    <button
        type="submit"
        class="register-btn">

        Register

    </button>

</form>

        <div class="login-link">

            Already have an account?

            <a href="login.php">

                Login

            </a>

        </div>

    </div>

</div>

<script src="assets/js/register.js"></script>
    
</body>
</html>