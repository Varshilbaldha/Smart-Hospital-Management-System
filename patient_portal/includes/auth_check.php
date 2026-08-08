<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Patient Authentication Check
|--------------------------------------------------------------------------
|
| This file protects all patient pages.
| If patient is not logged in,
| redirect to Login page.
|
*/

require_once "../../includes/config.php";
require_once "../../includes/functions.php";


/*====================================================
    CHECK PATIENT LOGIN
====================================================*/

if (
    !isset($_SESSION['patient_auth'])
    ||
    !isset($_SESSION['patient_auth']['logged_in'])
    ||
    $_SESSION['patient_auth']['logged_in'] !== true
)
{
    $_SESSION['error'] = "Please login to continue.";

    redirect("../login.php");
}


/*====================================================
    SESSION TIMEOUT
====================================================*/

$session_timeout = 60 * 60 * 2; // 2 Hours

if
(
    isset($_SESSION['patient_auth']['login_time'])
)
{

    if
    (
        (time() - $_SESSION['patient_auth']['login_time'])
        >
        $session_timeout
    )
    {

        session_unset();

        session_destroy();

        session_start();

        $_SESSION['error'] =
        "Session expired. Please login again.";

        redirect("../patient_portal/login.php");

    }

}


/*====================================================
    REFRESH LOGIN TIME
====================================================*/

$_SESSION['patient_auth']['login_time'] = time();


/*====================================================
    CURRENT PATIENT
====================================================*/

$patient = $_SESSION['patient_auth'];

?>