<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Forgot Password</title>

</head>

<body>

<h1>Forgot Password</h1>

<p>
    Enter your hospital application number.
    We will send an OTP to your registered administrator email.
</p>

<form id="forgotForm">

    <label>Application Number</label>

    <input
        type="text"
        id="application_no"
        name="application_no"
        required>

    <p id="error"></p>

    <button type="submit">
        Send OTP
    </button>

</form>


<script>

const form = document.getElementById("forgotForm");

const error = document.getElementById("error");


form.addEventListener("submit", function(e)
{

    e.preventDefault();

    const formData = new FormData(form);


    fetch("check_application.php",
    {
        method: "POST",

        body: formData
    })

    .then(response => response.text())

    .then(data =>
    {

        if(data.trim() === "not_found")
        {
            error.innerText = "Application Number not found.";

            error.style.color = "red";
        }

        else if(data.trim() === "found")
        {
            error.innerText = "";

            window.location.href = "send_reset_otp.php";
        }

    });

});

</script>

</body>

</html>