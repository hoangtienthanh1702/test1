<?php session_start(); 
 
    if (isset($_SESSION['username'])){
        if(isset($_SESSION['product'])){
            unset($_SESSION['product']);
        }
        unset($_SESSION['username']); // xóa session login
        header("location:login.php");
    }
?>


