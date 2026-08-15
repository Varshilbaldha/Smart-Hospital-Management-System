<?php

declare(strict_types=1);


/*====================================================
    LOAD GLOBAL CONFIG
====================================================*/

require_once dirname(__DIR__, 2) . '/includes/config.php';


/*====================================================
    CHECK REGISTRATION SESSION
====================================================*/

if (
    !isset($_SESSION['patient_registration']) ||
    !is_array($_SESSION['patient_registration'])
)
{
    $_SESSION['error'] =
        "Registration session expired. Please register again.";

    redirect("patient_registration.php");
}


/*====================================================
    CHECK OTP EXPIRY TIME
====================================================*/

$otp_expiry_time =
    (int) (
        $_SESSION['patient_registration']['otp_expiry_time']
        ?? 0
    );


$remaining_time = 0;


if ($otp_expiry_time > time())
{
    $remaining_time =
        $otp_expiry_time - time();
}


/*====================================================
    IF OTP ALREADY EXPIRED
====================================================*/

if ($remaining_time <= 0)
{
    $_SESSION['error'] =
        "Your OTP has expired. Please request a new OTP.";
}


/*====================================================
    PATIENT EMAIL
====================================================*/

$patient_email =
    $_SESSION['patient_registration']['email']
    ?? '';

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Verify OTP
    </title>


    <link
        rel="stylesheet"
        href="../assets/css/verify_otp.css"
    >

</head>


<body>


<div class="otp-card">


    <!--================================================
        TITLE
    =================================================-->

    <h2>
        Verify OTP
    </h2>


    <!--================================================
        DESCRIPTION
    =================================================-->

    <p>

        We have sent a 6-digit OTP to

        <br>

        <strong>

            <?= htmlspecialchars(
                $patient_email,
                ENT_QUOTES,
                'UTF-8'
            ); ?>

        </strong>

    </p>


    <!--================================================
        ERROR MESSAGE
    =================================================-->

    <?php if (isset($_SESSION['error'])): ?>

        <div class="otp-error">

            <?= htmlspecialchars(
                $_SESSION['error'],
                ENT_QUOTES,
                'UTF-8'
            ); ?>

        </div>

        <?php unset($_SESSION['error']); ?>

    <?php endif; ?>


    <!--================================================
        SUCCESS MESSAGE
    =================================================-->

    <?php if (isset($_SESSION['success'])): ?>

        <div class="otp-success">

            <?= htmlspecialchars(
                $_SESSION['success'],
                ENT_QUOTES,
                'UTF-8'
            ); ?>

        </div>

        <?php unset($_SESSION['success']); ?>

    <?php endif; ?>


    <!--================================================
        OTP FORM
    =================================================-->

    <form
        action="verify_otp_process.php"
        method="POST"
    >


        <label for="otp">

            Enter OTP

        </label>


        <input
            type="text"
            id="otp"
            name="otp"
            maxlength="6"
            minlength="6"
            pattern="[0-9]{6}"
            inputmode="numeric"
            autocomplete="one-time-code"
            required
            placeholder="Enter 6-digit OTP"
        >


        <br>
        <br>


        <button
            type="submit"
        >

            Verify OTP

        </button>


    </form>


    <!--================================================
        OTP TIMER
    =================================================-->

    <br>

    <p>

        OTP expires in

        <span id="timer">

            <?= $remaining_time; ?>

        </span>

        seconds

    </p>


    <!--================================================
        RESEND OTP
    =================================================-->

    <br>

    <a href="resend_otp.php">

        Resend OTP

    </a>


</div>


<!--====================================================
    OTP TIMER SCRIPT
=====================================================-->

<script>

let remainingTime =
    <?= (int) $remaining_time; ?>;

const timerElement =
    document.getElementById("timer");


const timer = setInterval(function ()
{

    if (remainingTime <= 0)
    {
        clearInterval(timer);

        timerElement.textContent = "Expired";

        return;
    }


    timerElement.textContent =
        remainingTime;


    remainingTime--;

}, 1000);

</script>


</body>

</html>