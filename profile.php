<?php
    include "connect.php";
    session_start();

    if (isset($_SESSION['username']) && $_SESSION['username']){
        echo 'Bạn đã đăng nhập với tên là '.$_SESSION['username']."<br/>";
        if($_SESSION['roles'] == "admin"){
            echo 'Vào trang quản lý của Admin <a href="admin.php">Ở đây!!</a> </br> ';
        }
        if($_SESSION['roles'] == "owner"){
            echo 'Vào trang quản lý của Owner <a href="owner.php">Ở đây!!</a> </br> ';
        }
        echo 'Click vào để xem trang cá nhân <a href="profile.php">Trang cá nhân của bạn</a></br>';
        echo 'Click vào đây để <a href="logout.php">Logout</a></br>';
        echo 'Click vào để xem giỏ hàng <a href="addcart.php">Gio Hang</a></br>';
        echo 'Click vào để nạp vip <a href="nap.php">Nạp vip</a></br>';
    }else{
        die('Bạn chưa đăng nhập !! </br><a href="login.php">login</a>');
    };


    if( isset($_POST['old-password']) && isset($_POST['new-password'])){
        $oldPassword = $_POST['old-password'];
        $newPassword = $_POST['new-password'];


        if($oldPassword != $newPassword){
            if (strlen($username) < 5 || strlen($newPassword) < 5) {
                echo "Tên đăng nhập và mật khẩu phải có ít nhất 5 ký tự.";
            } else if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{5,}$/", $newPassword)) {
                echo "Mật khẩu phải có ít nhất 5 ký tự, 1 chữ hoa, 1 chữ thường và 1 số.";
            }else {
                $id = $_SESSION['id'];
                $oldPassword = md5($oldPassword);
                $newPassword = md5($newPassword);
    
                $sql = "SELECT * FROM users WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
    
                if($row['password'] == $oldPassword){
                        $updateSql = "UPDATE users SET name = '$name', username = '$username', password = '$newPassword'   WHERE id = $id";
                        $updateResult = mysqli_query($conn, $updateSql);
                        if($updateResult){
                            echo "Update successfully";
                        }else{
                            echo "Update failed";
                        }
                }else{
                    echo "Password không đúng";
                }
            }
        }else{
            echo "Mật khẩu mới phải khác mật khẩu cũ";
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h2>Profile</h2>
    <div class="">
        <?php 
             $id = $_SESSION['id'];
             $sql = "SELECT * FROM users WHERE id = $id";
             $result = mysqli_query($conn, $sql);
             $row = mysqli_fetch_assoc($result);
        ?>
        <table border='1'>
            <tr>
                <td>Avatar</td>
                <td><img src="uploads/<?php echo $row["avatar"]; ?>" alt="" width="100px"></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $row["name"]; ?></td>
            </tr>
            <tr></tr>
                <td>Username</td>
                <td><?php echo $row["username"]; ?></td>
            </tr>
            <tr>
                <td>Money</td>
                <td><?php echo $row["money"]; ?></td>
            </tr>
            <tr>
                <td>Roles</td>
                <td><?php echo $row["roles"]; ?></td>
            </tr>
        </table>
    </div>

    <div class="">
        <h2>Avatar</h2>
        <form method="POST" action="edit_avatar.php" enctype="multipart/form-data">
            <input type="file" name="avatar" value="">
            <input type="submit" />
        </form>
    </div>


    <div class="">
        <h2>Edit Profile</h2>
        <form method="POST">
            <?php 
                $id = $_SESSION['id'];
                $sql = "SELECT * FROM users WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            ?>
            <table>

                <tr>
                    <td>old-password</td>
                    <td>
                        <input type="text" name="old-password" value="">
                    </td>
                </tr>
                <tr>
                    <td>New-Password</td>
                    <td>
                        <input type="text" name="new-password" value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" />
                    </td>
                </tr>
            </table>
        </form>
    </div>



</body>
</html>