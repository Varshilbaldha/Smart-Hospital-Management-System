<?php

declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';


function sendOTP(
    string $email,
    string $name,
    string $otp,
    string $title = "OTP Verification"
): bool
{

    $mail = new PHPMailer(true);

    try
    {

        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';

        $mail->SMTPAuth = true;

        $mail->Username = 'hospitalmanagement222@gmail.com';

        $mail->Password = 'evqnycxncsjydmgs';

        $mail->SMTPSecure =
            PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port = 587;

        $mail->setFrom(
            'hospitalmanagement222@gmail.com',
            'Smart Hospital Management System'
        );

        $mail->addAddress(
            $email,
            $name
        );

        $mail->isHTML(true);

        $mail->Subject = $title;

        $mail->Body = "

        <div style='max-width:650px;
                    margin:auto;
                    font-family:Arial;
                    background:#ffffff;
                    border-radius:10px;
                    padding:30px;
                    border:1px solid #e5e5e5;'>

            <h2 style='color:#4f46e5;'>

                Smart Hospital Management System

            </h2>

            <p>

                Dear <b>{$name}</b>,

            </p>

            <p>

                Your One Time Password (OTP) is

            </p>

            <div
            style='
            text-align:center;
            padding:20px;
            background:#eef2ff;
            border-radius:10px;
            margin:25px 0;'>

                <h1
                style='
                letter-spacing:8px;
                color:#4f46e5;'>

                    {$otp}

                </h1>

            </div>

            <p>

                This OTP will expire in
                <b>10 Minutes</b>.

            </p>

            <p>

                If you did not request this OTP,
                please ignore this email.

            </p>

            <hr>

            <small>

                This is an automated email.

            </small>

        </div>

        ";

        return $mail->send();

    }
    catch (Exception $e)
    {

        return false;

    }

}