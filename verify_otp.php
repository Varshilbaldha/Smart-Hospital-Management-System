<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="verify_otp.css">
</head>
<body>

<div class="main">

    <div class="otp">
    
        <h1>OTP Verification</h1>
        <p>An OTP has been sent to your email address.<br> Please enter the OTP below to verify your email.</p>
        <form action="" method="POST">
            <label for="otp">Enter OTP:</label>
            <input type="text" id="otp" name="otp" required><br>
            <p> Didn't receive the OTP? <a href="resend_otp.php">Resend</a></p>
            <button type="submit">Verify OTP</button>
        </form>
    </div>


</div>
    
</body>
</html>