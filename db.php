<?php
    $conn = mysqli_connect("localhost","Varshil2","B@ldh@ V@rshil","auth_system");

    if (!$conn) {
        die("connetion Error".mysqli_connect_errno());
    }

?>