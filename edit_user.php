<?php
    include "connect.php";
    session_start();
    if($_SESSION['roles'] == "admin"){
        echo 'Trang quản lý danh sách users ';

    }else{
        die('Bạn không có quyền truy cập vào trang này <a href="home.php">Trang chủ</a>');
    }

    $id = $_GET['id'];

    if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['roles'])){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $roles = $_POST['roles'];
        $sql = "UPDATE users SET name = '$name', username = '$username', roles = '$roles' WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "~~~~~~~~~ Edit successfully ~~~~~~~~~";
            header("Location: admin.php");
        }else{
            echo "Edit failed";
        }
    }else{
        echo("demo") ;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
</head>
<body>
        <div class="">
            <a href="home.php">Home</a>
            </br>
            <a href="addproduct.php">Them san pham</a>
            </br>
            <a href="admin.php">Quan ly user</a>
            </br>
            <a href="manage_order.php">Quản lý đơn hàng</a>
        </div>
    <!--  edit  -->
    <div class="">
        <?php 
            $id = $_GET['id'];
            $sql = "SELECT * FROM users WHERE id = $id";
            $result = mysqli_query($conn, $sql);
            // echo(mysqli_num_rows($result) . "<br>");
        ?>
        <table border="1">
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Username</th>
                <th>Roles</th>
            </tr>
            <?php 
                $i = 1;
                while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['roles']; ?></td>

            </tr>
            <?php 
                $i++;
                }
            ?>
        </table>
    </div>
    <div class="">
        <h2>Edit user</h2>
        <form action="" method="post">
            <?php 
                $id = $_GET['id'];
                $sql = "SELECT * FROM users WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result)

            ?>
            <div class="">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" placeholder="Enter your name">
            </div>
            <div class="">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?php echo $row['username']; ?>" placeholder="Enter your username">
            </div>
            <div class="">
                <label for="roles">Roles</label>
                <select name="roles" id="roles">
                    <option value="admin">admin</option>
                    <option value="owner">owner</option>
                    <option value="user">user</option>
                </select>
            </div>
            <div class="">
                <button type="submit">Edit</button>
            </div>
        </form>
</body>
</html>
