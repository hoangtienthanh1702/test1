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
    if(isset($_POST['nap'])){
        $nap = $_POST['nap'];
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            if($row['id'] == $_SESSION['id']){
                $money = $row['money'];
                if($nap < 0){
                    echo "Số tiền không hợp lệ";
                }else{
                    $newMoney = $money + $nap;
                    $updateSql = "UPDATE users SET money = $newMoney WHERE id = $_SESSION[id]";
                    $updateResult = mysqli_query($conn, $updateSql);
                    if($updateResult){
                        echo "Nạp tiền thành công";
                    }else{
                        echo "Nạp tiền thất bại";
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
    } ?>
    
    <div class="center">
        <div class="">
            <!-- Hiển thị giỏ hàng -->
            <h2>Nap Vip</h2>
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
                <label for="nap">Nhập số tiền cần nạp : </label>
                </br>
                <input type="text" name='nap' id='nap'> ( Đơn vị Nghìn  k)
                </br>
                <button type="submit">Submit</button>
        </div>


    </div>
    

</body>
<script>
    function addToCart(){
        alert(`Đã mua sản phẩm vào thành công`);
    }
</script>
</html>


