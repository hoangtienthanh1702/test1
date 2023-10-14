<?php session_start(); 
 
    if(isset($_SESSION['username']) || isset($_SESSION['product'])){
        unset($_SESSION['username']);
        unset($_SESSION['product']);
        unset($_COOKIE['username']);
        setcookie('token', '', time() - 3600);
        header("location:login.php");
    }
?>


