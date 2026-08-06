<?php

require_once "../includes/patient_auth.php";

?>

<!DOCTYPE html>

<html>

<head>

<title>

Patient Dashboard

</title>

</head>

<body>

<h1>

Welcome

<?php

echo htmlspecialchars(

$_SESSION['patient_auth']['first_name']

);

?>

</h1>

<p>

Login Successful 🎉

</p>

<a href="logout.php">

Logout

</a>

</body>

</html>