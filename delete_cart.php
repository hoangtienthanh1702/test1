<?php session_start(); 
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        unset($_SESSION['product'][$id]);
    }
    header("Location: addcart.php");
?>