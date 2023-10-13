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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>
<body>
    <div class="center">
        <h2>HOME</h2>
        <?php
            echo 'Xin chào ' . $_SESSION['name'] . "<br>";
            if(isset($_POST['id']) && isset($_POST['quantity'])){
                $id = $_POST['id'];
                $quantity = $_POST['quantity'];
                if($quantity < 0){
                    echo "Số lượng không hợp lệ";
                }else{
        
                    $sql = "SELECT * FROM product WHERE id = $id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $name = $row['name'];
                    $price = $row['price'];
                    $img = $row['img'];
                    $array = array(
                        'id' => $id,
                        'name' => $name,
                        'price' => $price,
                        'img' => $img,
                        'quantity' => $quantity
                    );
                    
                    if(isset($_SESSION['product'][$id])){
                        $_SESSION['product'][$id]['quantity'] += $quantity;
                    }else{
                        $_SESSION['product'][$id] = $array;
                    }
                    
                    echo "Đã thêm vào giỏ hàng " . $_SESSION['product'][$id]['name'] . " với số lượng là " . $quantity . "<br>";
                }
                
            }
        ?>

        <div class="">
            <!-- truy vấn sql lấy giỏ hàng -->
            <?php 
                $sql = "SELECT * FROM product";
                $result = mysqli_query($conn, $sql);
            ?>
            
                <table border="1">
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Describe</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                        $i = 1;
                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <form method='post'>
                        <tr>
                            <td>
                                <?php echo $i; ?>
                                <input type='hidden' name='id' value=<?php echo $row["id"] ?> />
                           </td>
                            <td><?php echo $row['name']; ?></td>
                            <td><img src="<?php echo $row['img']; ?>" alt="" width="100px"></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><input type="number" id="quantity" name="quantity" min="1" onchange="checkQuantity(this)" value="1" ></td>
                            <td><?php echo $row['description']; ?></td>
                            <td>
                                <a href="home.php?product=<?php echo $row["id"] ?>">
                                    <button type="submit" onclick='addToCart()'>Add to cart</button>
                                </a>
                            </td>
                        </tr>
                    </form>
                    <?php 
                        $i++;
                        }
                    ?>
                </table>
            </form>
        </div>

    </div>
</body>

</html>

