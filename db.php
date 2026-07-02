<?php
    $conn = mysqli_connect("localhost","Hospital","B@ldh@ V@rshil","hospital_management");

    if (!$conn) {
        die("connetion Error".mysqli_connect_errno());
    }

?>