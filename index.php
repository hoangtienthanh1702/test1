<?php 
    include "token.php";
    if(isset($_SESSION['username']) && $_SESSION['username']){
        header("location:home.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>trang chu</title>

</head>

<body>
        <div>
            <a href="login.php">Login</a>
        </div>
        <div>
            <a href="register.php">Register</a>
        </div>
</body>

</html>