<?php

declare(strict_types=1);

require_once "config.php";

/*===
    PATIENT LOGIN CHECK
======================================*/

if
(!isset($_SESSION['patient_auth'])||$_SESSION['patient_auth']['logged_in'] !== true
) {
    $_SESSION['error'] =
        "Please login first.";

    header("Location: ../Patient_Portal/login.php");
    exit();
}

/*=====================================
    SESSION TIMEOUT
======================================*/

$timeout = 1800; // 30 Minutes

if
(
    time() -
    $_SESSION['patient_auth']['last_activity']
    >
    $timeout
) {

    session_unset();

    session_destroy();

    header("Location: ../Patient_Portal/login.php");

    exit();

}

/*=====================================
    UPDATE LAST ACTIVITY
======================================*/

$_SESSION['patient_auth']['last_activity'] = time();

?>