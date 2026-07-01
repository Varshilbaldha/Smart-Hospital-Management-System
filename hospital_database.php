<?php 
$conn = mysqli_connect('localhost','Varshil2','B@ldh@ V@rshil', 'hospital_management');

if(!$conn)
    {
        die("conncetion not Establist");
    }
else{
    echo "Connection successfull";
}



?>