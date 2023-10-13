<?php
    session_start();
    include "connect.php";
    $id = $_GET["id"];  
    echo $id;
    if($_SESSION['roles'] == "admin"){
        echo 'Trang quản lý danh sách users ';
    }else{
        die('Bạn không có quyền truy cập vào trang này <a href="home.php">Trang chủ</a>');
    }
    $sql = "DELETE FROM `users` WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: admin.php");
    } else {
    echo "Failed: " . mysqli_error($conn);
}