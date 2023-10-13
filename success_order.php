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
            <h2>Đơn hàng của bạn</h2>
            <?php 
                if(isset($_SESSION['name']) && isset($_SESSION['money'])  ){
                    echo "Xin chào " . $_SESSION['name'];
                    echo "<br>";
                    echo "Số tiền còn lại là " . $_SESSION['money'] .'k' ;
                    echo "<br>";
                }
            ?>
        <div class="">
            <table border="1">
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Ảnh</th>
                </tr>
                <?php 
                    $id = $_SESSION['id'];
                    $sql = "SELECT cart.*, product.name as product_name , product.img , product.price , product.description , users.username, users.name FROM cart JOIN product ON cart.product_id = product.id JOIN users ON cart.user_id = users.id  WHERE users.id = $id";
                    $result = mysqli_query($conn, $sql);
                    $i = 1;
                    $total = 0;
                    $num = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $total += intval($row['price']) * $row['quantity'];
                        $num += $row['quantity'] ;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo intval($row['price']) * $row['quantity'] . "k" ?></td>
                    <td><img width="100px" src="<?php echo $row['img']; ?>"/></td>


                </tr>
                <?php 
                    $i++;
                }
                ?>
                <tr>
                            <td colspan="5">Tổng tiền</td>
                            <td colspan="1"><?php echo $num ?></td>
                            <td colspan="1"><?php echo $total ."k" ?></td>
                        </tr>
            </table>
        </div>


    </div>
    

</body>
<script>
    function addToCart(){
        alert(`Đã mua sản phẩm vào thành công`);
    }
</script>
</html>
