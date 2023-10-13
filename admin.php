<?php
    include "connect.php";
    session_start();
    if($_SESSION['roles'] == "admin"){
        echo 'WELCOME';
        echo '</br>';
    }else{
        die('Bạn không có quyền truy cập vào trang này <a href="home.php">Trang chủ</a>');
    }
    $role = $_SESSION['roles'];
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
        <div class="">
            <table border="1">
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
                <?php 
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql);
                    $i = 1;
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['roles']; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="delete_user.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php 
                    $i++;
                    }
                ?>
            </table>
        </div>
</body>
</html>