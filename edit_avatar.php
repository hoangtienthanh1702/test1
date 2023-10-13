<?php 
    include "connect.php";
    session_start();

    if(isset($_FILES['avatar']['name'])){
        $id = $_SESSION['id'];
        $avatar = $_FILES['avatar']['name'];
        $tmp_name = $_FILES['avatar']['tmp_name'];
        $path = "uploads/";
        $target_file = $path.$avatar;
        $avatarType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($avatarType != "jpg" && $avatarType != "png" && $avatarType != "jpeg" && $avatarType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }else{
            move_uploaded_file($tmp_name, $target_file);
            $updateSql = "UPDATE users SET avatar = '$avatar' WHERE id = $id";
            $updateResult = mysqli_query($conn, $updateSql);
            if($updateResult){
                echo "Update successfully";
                header("Location: profile.php");
            }else{
                echo "Update failed";
            }
        }

    }else{
        echo("demo") ;
    }
?>