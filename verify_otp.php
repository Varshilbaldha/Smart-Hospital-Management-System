<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OTP Verification</title>

    <link rel="stylesheet" href="verify_otp.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<div class="main">

    <div class="otp-card">

        <div class="icon">
            <i class="fa-solid fa-shield-heart"></i>
        </div>

        <h1>OTP Verification</h1>

        <p class="msg">
            We have sent a <b>6-digit verification code</b><br>
            to your registered administrator email address.
        </p>

        <form action="" method="POST">

            <label>Enter OTP</label>

            <div class="otp-box">

                <input type="text" maxlength="1" class="number" name="otp1" required>
                <input type="text" maxlength="1" class="number" name="otp2" required>
                <input type="text" maxlength="1" class="number" name="otp3" required>
                <input type="text" maxlength="1" class="number" name="otp4" required>
                <input type="text" maxlength="1" class="number" name="otp5" required>
                <input type="text" maxlength="1" class="number" name="otp6" required>

            </div>

            <p class="timer">

                Didn't receive the OTP?

                <a href="">Resend OTP</a>

            </p>

            <button type="submit">

                <i class="fa-solid fa-circle-check"></i>

                Verify OTP

            </button>

        </form>

    </div>

</div>

<script>

let boxes=document.querySelectorAll(".number");

boxes.forEach((box,index)=>{

box.addEventListener("input",function(){

this.value=this.value.replace(/[^0-9]/g,'');

if(this.value.length==1 && index<boxes.length-1){

boxes[index+1]  .focus();

}

});

box.addEventListener("keydown",function(e){

if(e.key==="Backspace" && this.value=="" && index>0){

boxes[index-1].focus();

}

});

});

</script>

</body>
</html>