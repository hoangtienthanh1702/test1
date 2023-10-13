<?php
    include "connect.php";
    session_start();
    if($_SESSION['roles'] == "owner"){
        echo 'Ban la owner </br>';
        echo 'Trang quản lý danh sách mua hàng ';
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
<div class="">
            <a href="home.php">Home</a>
            </br>
            <a href="addproduct.php">Them san pham</a>
            </br>
            <a href="admin.php">Quan ly user</a>
            </br>
            <a href="manage_order.php">Quản lý đơn hàng</a>
        </div>
        <div class="">
            <table border="1">
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Ảnh</th>

                </tr>
                <?php 
                    $id = $_GET['id'];
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
                    <td><?php echo $row['username']; ?></td>
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
                            <td colspan="1"></td>
                        </tr>
            </table>
        </div>

</body>
</html>