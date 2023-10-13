<?php
    // Kết nối đến cơ sở dữ liệu
    include "connect.php";
    session_start();

    if (isset($_SESSION['username']) && $_SESSION['username']){
        echo 'Bạn đã đăng nhập với tên là '.$_SESSION['username']."<br/>";
        if($_SESSION['roles'] == "admin"){
            echo 'Vào trang quản lý user <a href="admin.php">Ở đây!!</a> </br> ';
        }
        echo 'Click vào đây để <a href="logout.php">Logout</a></br>';
        echo 'Click vào để xem sản phẩm <a href="home.php">Sản Phẩm</a></br>';
    }else{
        die('Bạn chưa đăng nhập !! </br><a href="login.php">login</a>');
    }
    
    // đóng form dòng 88
    // id product 
    if(isset($_POST['id'])){
        // id user
        if(isset($_SESSION['id'])){
            $user_id = $_SESSION['id'];
            $total = 0;

            if(isset($_SESSION['product'])){
                foreach($_SESSION['product'] as $value){
                    $total += intval($value['price']) * $value['quantity'] ;
                    $money = $_SESSION['money'];
                    if($money < $total){
                        echo "Số tiền của bạn không đủ để mua hàng <a href='home.php'>Quay lại mua hàng</a>";

                        exit;
                    }
                    $newMoney = $money - $total;

                    $sql = "INSERT INTO cart (product_id, user_id ,quantity , total) VALUES ($value[id], $user_id ,'$value[quantity]' , '$total')";
                    $updateSql = "UPDATE users SET money = $newMoney WHERE id = $user_id";
                    $result = mysqli_query($conn, $sql);
                    $updateResult = mysqli_query($conn, $updateSql);
                    if($result && $updateResult){
                        echo "~~~~~~~~~ Add successfully ~~~~~~~~~";
                        header("Location: success_order.php");
                    }else{
                        echo "Add failed";
                    }
                }
            }
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <?php if(!isset($_SESSION['product'])){
        echo "Giỏ hàng trống <a href='home.php'>Quay lại mua hàng</a> ";
        exit;
    } ?>
    
    <div class="center">
        <div class="">
            <!-- Hiển thị giỏ hàng -->
            <h2>Giỏ Hàng</h2>
            <?php 
            $sqlUser = "SELECT * FROM users";
            $resultUser = mysqli_query($conn, $sqlUser);
            while($row = mysqli_fetch_assoc($resultUser)){
                if($row['id'] == $_SESSION['id']){
                    $money = $row['money'];
                    $_SESSION['money'] = $money;
                }
            }            
                if(isset($_SESSION['name']) && isset($_SESSION['money'])  ){
                    echo "Xin chào " . $_SESSION['name'];
                    echo "<br>";
                    echo "Số tiền của bạn là " . $_SESSION['money'] . "k" ;
                }
            ?>
         <form method="post">
                <table border="1">
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Ảnh</th>
                        <th>Thao tác</th>
                    </tr>
                    <?php
                        $total = 0;
                        if(isset($_SESSION['product'])){
                            $i = 0;
                                foreach($_SESSION['product'] as $value){
                                    $i++;
                                    $total += intval($value['price']) * $value['quantity'];
                                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td name="name"><?php echo $value['name']; ?></td>
                        <td><?php echo $value['price']; ?></td>
                        <td name="quantity"><?php echo $value['quantity']; ?></td>
                        <td><?php echo intval($value['price']) * $value['quantity'] . "k"; ?></td>
                        <td><img src="<?php echo $value['img']; ?>" alt="" width="100px"></td>
                        <td><a href="delete_cart.php?delete=<?php echo $value['id']; ?>">Xóa</a></td>
                        <input type="hidden" name="id" value="<?php echo $value['id'] ?>" />
                    </tr>
                    <?php
                            }
                        }
                    ?>

                        <tr>
                            <td colspan="4">Tổng tiền</td>
                            <td colspan="1"><?php echo $total ."k" ?></td>
                            <td colspan="1">
                                <button type="submit">Xác nhận mua</button>
                            </td>
                        </tr>
                    </table>
                </form>
        </div>


    </div>
    

</body>

</html>
