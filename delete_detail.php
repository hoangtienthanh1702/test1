<?php 
    include "connect.php";
    $users_id = $_GET['users_id'];
    $id = $_GET['id'];
    $sql = "DELETE FROM cart WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        header("Location: detail_order.php?id=$users_id");
    }else{
        echo "Lỗi";
    }

?>