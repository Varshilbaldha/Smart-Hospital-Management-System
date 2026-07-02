<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);

$conn = mysqli_connect('localhost', 'Hospital_management', 'B@ldh@ V@rshil', 'hospital_management');

if (!$conn) {
    die("conncetion not Establist" . mysqli_connect_errno());
} else {

    $hospital_name = $_SESSION['hospital_name'];
    $registration_no = $_SESSION['registration_no'];
    $application_no = $_SESSION['application_no'];
    $hospital_type = $_SESSION['hospital_type'];

    $hospital_email = $_SESSION['hospital_email'];
    $hospital_phone = $_SESSION['hospital_phone'];
    $emergency_no = $_SESSION['emergency_no'];
    $website = $_SESSION['website'];

    $address1 = $_SESSION['address1'];
    $address2 = $_SESSION['address2'];
    $city = $_SESSION['city'];
    $state = $_SESSION['state'];
    $zip = $_SESSION['zip'];

    $admin_name = $_SESSION['admin_name'];
    $admin_username = $_SESSION['admin_username'];
    $admin_email = $_SESSION['admin_email'];
    $admin_mobile = $_SESSION['admin_mobile'];

    $password = password_hash($_SESSION['password'], PASSWORD_DEFAULT);

    $application_no = $_SESSION['application_no'];
    $license_doc = $_SESSION['license_doc'];


    $query = "INSERT INTO hospital_registration (application_no,hospital_name, registration_no, hospital_type, hospital_email, hospital_phone, emergency_no, website, address1, address2, city, state, zip, admin_name, admin_username, admin_email, admin_mobile, password, license_doc) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        die(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "sssssssssssssssssss", $application_no ,$hospital_name,$registration_no,  $hospital_type, $hospital_email, $hospital_phone, $emergency_no, $website, $address1, $address2, $city, $state, $zip, $admin_name, $admin_username, $admin_email, $admin_mobile, $password, $license_doc);



    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
            alert('Registration Successful');
            window.location='login.php';
        </script>";
        exit();
    } else {
        echo "<script>alert('Registration Failed');</script>";
        echo mysqli_error($conn);
    }

}



?>