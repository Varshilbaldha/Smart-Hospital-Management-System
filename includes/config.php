<?php



error_reporting(E_ALL);
ini_set('display_errors',"1");

date_default_timezone_set('Asia/Kolkata');

if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}

$host = "localhost";
$username = "Hospital_management";
$password = "B@ldh@ V@rshil";
$database = "hospital_management";

$conn = mysqli_connect(
    $host,
    $username,
    $password,
    $database
);

if (!$conn)
{
    die("Database Connection Failed : " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

?>