<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <script>
        function validation(event)
        {
            let username = document.getElementById("username").value.trim();
            let password = document.getElementById("password").value.trim();

            let usernamePattern = /^[a-zA-Z0-9_]{3,15}$/;
            let passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,20}$/;

            if(!usernamePattern.test(username))
        {   
               document.getElementById("msg1").innerHTML = "Enter Valid Username";
                 event.preventDefault();
                 return;
        }
            if(!passwordPattern.test(password))

            {
                document.getElementById("msg").innerHTML = "* Password must contain at least 8 characters, one uppercase letter, one lowercase letter, one number, and one special character.";
                 event.preventDefault();
                return;
            }
        }
        
    </script>
    <h2 style="text-align: center;">Login</h2>

    <form method="post" onsubmit="validation(event)" action="check.php">
    <div class="box">

        <h3>Username : <input type="text" name="username" id="username" class="input"><br><Br>
            <p style="color:red;font-size:16px;margin-top:-2px;"  id="msg1"></p>
           

            Password : 
            <input type="password" name="password" id="password" class="input">
             <p style="color:red;font-size:16px;margin-top:-2px;"  id="msg"></p>




    </div>

    <div class="login">
        <input type="submit">
    </div>
</form>
</body>
</html>