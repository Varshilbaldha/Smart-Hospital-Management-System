<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['hospital_name'] = $_POST['hname'];
    $_SESSION['registration_no'] = $_POST['lino'];
    $_SESSION['hospital_type'] = $_POST['htype'];

    $_SESSION['hospital_email'] = $_POST['email'];
    $_SESSION['hospital_phone'] = $_POST['phone'];
    $_SESSION['emergency_no'] = $_POST['eno'];
    $_SESSION['website'] = $_POST['website'];

    $_SESSION['address1'] = $_POST['address1'];
    $_SESSION['address2'] = $_POST['address2'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['zip'] = $_POST['zip'];

    $_SESSION['admin_name'] = $_POST['adminname'];
    $_SESSION['admin_username'] = $_POST['adminusername'];
    $_SESSION['admin_email'] = $_POST['adminemail'];
    $_SESSION['admin_mobile'] = $_POST['adminmobile'];
    $_SESSION['password'] = $_POST['adminpassword'];
} else {
    die("Invalid Request Method");

}



$required = [
    'hname',
    'lino',
    'htype',
    'email',
    'phone',
    'eno',
    'address1',
    'address2',
    'city',
    'state',
    'zip',
    'adminname',
    'adminusername',
    'adminemail',
    'adminmobile',
    'adminpassword'
];

foreach ($required as $field) {
    if (!isset($_POST[$field]) || trim($_POST[$field]) == "") {
        die("Error: $field is required.");
    }
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    die("Invalid Hospital Email.");
}

if (!filter_var($_POST['adminemail'], FILTER_VALIDATE_EMAIL)) {
    die("Invalid Administrator Email.");
}

if (!preg_match('/^[6-9][0-9]{9}$/', $_POST['phone'])) {
    die("Invalid Hospital Phone Number.");
}

if (!preg_match('/^[6-9][0-9]{9}$/', $_POST['eno'])) {
    die("Invalid Emergency Number.");
}

if (!preg_match('/^[6-9][0-9]{9}$/', $_POST['adminmobile'])) {
    die("Invalid Administrator Mobile Number.");
}

if (!preg_match('/^[0-9]{6}$/', $_POST['zip'])) {
    die("Invalid Zip Code.");
}


$password = $_POST['adminpassword'];

if (
    strlen($password) < 8 ||
    !preg_match('/[A-Z]/', $password) ||
    !preg_match('/[a-z]/', $password) ||
    !preg_match('/[0-9]/', $password) ||
    !preg_match('/[@$!%*?&]/', $password)
) {
    die("Password is not strong enough.");
}
if (!isset($_FILES['license_doc']) || $_FILES['license_doc']['error'] != 0) {
    die("Please upload License Document.");
}

$allowed = [
    "application/pdf",
    "image/jpeg",
    "image/png"
];

if (!in_array($_FILES['license_doc']['type'], $allowed)) {
    die("Only PDF, JPG and PNG files are allowed.");
}

if ($_FILES['license_doc']['size'] > 200 * 1024) {
    die("License document must be less than 200 KB.");
}


$otp = rand(100000, 999999);

// Store OTP in Session
$_SESSION['otp'] = $otp;

$_SEESION['otp_generated_time'] = time();
$_SEESION['otp_expiry_time'] = $_SESSION['otp_generated_time'] + 900;


$_SESSION['application_no'] = "APP" . date("YmdHis") . rand(100, 999);




use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {

    // Tell PHPMailer to use SMTP
    $mail->isSMTP();

    // Gmail SMTP Server
    $mail->Host = 'smtp.gmail.com';

    // Enable SMTP Authentication
    $mail->SMTPAuth = true;

    // Your Gmail Address
    $mail->Username = 'hospitalmanagement222@gmail.com';

    // Your App Password
    $mail->Password = 'evqnycxncsjydmgs';

    // Encryption
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // Gmail Port
    $mail->Port = 587;

    // Sender
    $mail->setFrom(
        'hospitalmanagement222@gmail.com',
        'Hospital Management System'

    );

    // Receiver
    $mail->addAddress('hiraparamargish@gmail.com');

    // Email Format
    $mail->isHTML(true);

    // Subject
    $mail->Subject = 'Hospital Registration - OTP Verification';

    // Message

    $mail->Body = 'Dear **Administrator**,

Greetings from the **Hospital Management System**.

Thank you for registering your hospital on our platform. Your registration request has been received successfully.

**Registration Details**

* **Hospital Name:** <?= $hospital_name ?>
* **Application Number:** <?= $application_no ?>
* **Administrator:** <?= $admin_name ?>
* **Administrator Email:** <?= $admin_email ?>

### One-Time Password (OTP)

**OTP:** **<?= $otp ?>**

This OTP is valid for **30 minutes** from the time this email was sent.

Please enter this OTP on the verification page to complete your hospital registration.

### Important Security Information

* Do **not** share this OTP with anyone.
* Our team will **never** ask for your OTP by phone, email, or message.
* If you did not initiate this registration, please ignore this email.

If you need assistance, please contact our support team.

Thank you for choosing the **Hospital Management System**.

Regards,

**Hospital Management System Team**
';


    $mail->send();


    echo "Email Sent Successfully.";

} catch (Exception $e) {

    echo "Email could not be sent.";

    echo "<br>";

    echo $mail->ErrorInfo;

}

?>