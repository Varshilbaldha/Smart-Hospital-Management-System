<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$hospital_name = $_POST['hname'];
$admin_email   = $_POST['adminemail'];
}

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
    $mail->Username = 'khulajasimsim7@gmail.com';

    // Your App Password
    $mail->Password = 'znfvsgzcotiiladw';

    // Encryption
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // Gmail Port
    $mail->Port = 587;

    // Sender
    $mail->setFrom(
        'khulajasimsim7@gmail.com
',
        
    );

    // Receiver
    $mail->addAddress('prithirpara52@gmail.com');

    // Email Format
    $mail->isHTML(true);

    // Subject
    $mail->Subject = 'PHPMailer Test';

    // Message

    $mail->Body = '';
    

    $mail->send();


    echo "Email Sent Successfully.";

}
catch (Exception $e){

    echo "Email could not be sent.";

    echo "<br>";

    echo $mail->ErrorInfo;

}

?>