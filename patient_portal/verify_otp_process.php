<?php

require_once "../includes/config.php";
require_once "../includes/functions.php";
require_once "../includes/validation.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST")
{
    redirect("register.php");
}

/* ==================================
   Registration Session Check
================================== */

if (!isset($_SESSION['patient_registration']))
{
    redirect("register.php");
}

$patient = $_SESSION['patient_registration'];

$entered_otp = cleanInput($_POST['otp'] ?? '');

/* ==================================
   OTP Format Validation
================================== */

if (!validateOTP($entered_otp))
{
    die("Invalid OTP.");
}

/* ==================================
   OTP Expiry Check
================================== */

if (time() > $patient['otp_expiry_time'])
{
    unset($_SESSION['patient_registration']);

    die("OTP has expired. Please register again.");
}

/* ==================================
   Wrong Attempt Limit
================================== */

if ($patient['otp_attempts'] >= 3)
{
    unset($_SESSION['patient_registration']);

    die("Maximum OTP attempts exceeded.");
}

/* ==================================
   OTP Match
================================== */

if ($entered_otp != $patient['otp'])
{
    $_SESSION['patient_registration']['otp_attempts']++;

    die("Incorrect OTP.");
}

/* ==================================
   Insert Patient
================================== */

$query = "

INSERT INTO patient_accounts

(
    patient_uuid,
    first_name,
    last_name,
    email,
    mobile,
    password,
    registration_source,
    mobile_verified,
    account_status,
    created_by_hospital
)

VALUES

(
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
)

";

$stmt = mysqli_prepare($conn, $query);

if (!$stmt)
{
    die(mysqli_error($conn));
}

$mobile_verified = 1;

mysqli_stmt_bind_param(

    $stmt,

    "sssssssiss",

    $patient['patient_uuid'],

    $patient['first_name'],

    $patient['last_name'],

    $patient['email'],

    $patient['mobile'],

    $patient['password'],

    $patient['registration_source'],

    $mobile_verified,

    $patient['account_status'],

    $patient['created_by_hospital']

);

if (!mysqli_stmt_execute($stmt))
{
    die(mysqli_error($conn));
}

/* ==================================
   Registration Completed
================================== */

unset($_SESSION['patient_registration']);

$_SESSION['success'] =
"Registration completed successfully.";

redirect("login.php");