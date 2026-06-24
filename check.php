<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Check empty fields
    if (empty($username) || empty($password)) {
        echo "<script>
                alert('Please fill all fields');
                window.location.href='login.php';
              </script>";
        exit();
    }
    if (!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)) {
        die("Invalid username");
    }

    if (
        !preg_match(
            "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,20}$/",
            $password
        )
    ) {
        die("Invalid password");
    }

    // Prepare query
    $stmt = mysqli_prepare(
        $conn,
        "SELECT username, password FROM users WHERE username = ?"
    );

    if (!$stmt) {
        die("Prepare Failed: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $username);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Username not found
    if (mysqli_num_rows($result) == 0) {
        echo "<script>
                alert('Username Not Found');
                window.location.href='login.php';
              </script>";
        exit();
    }

    $row = mysqli_fetch_assoc($result);
        

    // Verify password
    if ($password == $row['password']) {
        
       $_SESSION['username'] = $row['username'];

        echo "<script>
                alert('Login Successful');
                
                window.location.href='dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Wrong Password');
                window.location.href='login.php';
              </script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: index.php");
    exit();
}
?>