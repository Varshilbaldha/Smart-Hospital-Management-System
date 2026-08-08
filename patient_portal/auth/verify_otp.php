<?php

require_once "../includes/config.php";

if (!isset($_SESSION['patient_registration']))
{
    header("Location: register.php");
    exit();
}

$remaining_time =
$_SESSION['patient_registration']['otp_expiry_time'] - time();

if ($remaining_time <= 0)
{
    unset($_SESSION['patient_registration']);

    die("OTP has expired. Please register again.");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Verify OTP</title>

    <link
    rel="stylesheet"
    href="assets/css/verify_otp.css">

</head>

<body>

<div class="container">

    <div class="otp-card">

        <h2>

            Verify OTP

        </h2>

        <p>

            We have sent a 6-digit OTP to

            <br>

            <strong>

                <?php
                echo htmlspecialchars(
                    $_SESSION['patient_registration']['email']
                );
                ?>

            </strong>

        </p>

        <form
        action="verify_otp_process.php"
        method="POST">

            <input

                type="text"

                name="otp"

                maxlength="6"

                minlength="6"

                required

                placeholder="Enter OTP"

            >

            <br><br>

            <button type="submit">

                Verify OTP

            </button>

        </form>

        <br>

        <p>

            OTP expires in

            <span id="timer">

                <?php echo $remaining_time; ?>

            </span>

            seconds

        </p>

        <br>

        <a href="resend_otp.php">

            Resend OTP

        </a>

    </div>

</div>

<script>

let time =
<?php echo $remaining_time; ?>;

const timer =
document.getElementById("timer");

setInterval(function(){

    if(time>0)
    {
        time--;

        timer.innerHTML=time;
    }

},1000);

</script>

</body>

</html>