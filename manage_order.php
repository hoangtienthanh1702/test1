<?php
    include "connect.php";
    session_start();
    if($_SESSION['roles'] == "admin" || $_SESSION['roles'] == "owner"){
        $role = $_SESSION['roles'];
        echo 'Trang quản lý danh sách mua hàng </br> ';
        echo 'Ban la '.$role.'</br>';
        echo '<a href="home.php">Home</a>';
        echo '</br>';
        echo '<a href="addproduct.php">Them san pham</a>';
        echo '</br>';
        if($_SESSION['roles'] == "admin") {
            echo '<a href="admin.php">Quan ly user</a>'; 
            echo '</br>';
        }
        echo '<a href="manage_order.php">Quản lý đơn hàng</a>';
    }else{
        die('Bạn không có quyền truy cập vào trang này <a href="home.php">Trang chủ</a>');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
</head>
<body>
    <form>
        <div class="">
            <?php 
                $sql = "SELECT DISTINCT users.username, users.name , users.id FROM cart JOIN users ON cart.user_id = users.id";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
            ?>
            <p>Đơn mua của  <?php echo $row['name']; ?> (<a href="detail_order.php?id=<?php echo $row['id'] ?>">Chi tiết</a>) </p>
            <?php
            }
            ?>
        </div>        
    </form>

</body>
</html>