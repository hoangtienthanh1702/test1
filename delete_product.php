<?php
    include "connect.php";
    $id = $_GET["id"];  
    $sql = "DELETE FROM `product` WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: addproduct.php");
    } else {
    echo "Failed: " . mysqli_error($conn);
}