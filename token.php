<?php 
    include "connect.php";
    session_start();
    if(isset($_COOKIE['token'])){
        $sql = "SELECT * FROM users WHERE token = '".$_COOKIE['token']."' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['roles'] = $row['roles'];
        $_SESSION['money'] = $row['money'];
    }
?>