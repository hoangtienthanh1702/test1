<?php
    // Bao gồm tệp kết nối cơ sở dữ liệu
    include "connect.php";

    // Bắt đầu phiên PHP
    session_start();

    // Lấy ID sản phẩm từ tham số truy vấn URL
    $id = $_GET["id"];

    // Kiểm tra xem người dùng có vai trò 'admin' trong phiên của họ hay không
    if ($_SESSION['roles'] == "admin" || $_SESSION['roles'] == "owner") {
        // Hiển thị thông báo cho bảng điều khiển admin
        echo 'Trang quản lý danh sách sản phẩm ';
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

        // Kiểm tra xem dữ liệu biểu mẫu để chỉnh sửa sản phẩm đã được gửi
        if (isset($_POST['name']) && isset($_FILES["img"]["name"]) && isset($_POST['price']) && isset($_POST['desc'])) {
            $name = $_POST['name'];
            $price = $_POST['price']; 
            $desc =  $_POST['desc'];

            // Upload file
            $targer_dir = "uploads/";

            $targer_basename = basename($_FILES["img"]["name"]);
            $target_file = $targer_dir . $targer_basename;
            $file = $target_file;

            if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)){
                echo "hình ảnh đã được tải lên";
            } else{
                echo "Có lỗi khi tải hình ảnh lên";
            }   


            // Câu lệnh SQL để cập nhật sản phẩm
            $sql = "UPDATE product SET name = '$name', img = '$file', price = '$price', description = '$desc' WHERE id = $id";
            echo $sql;
            // exit;
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "~~~~~~~~~ Chỉnh sửa thành công ~~~~~~~~~";
                header("Location: addproduct.php"); // Chuyển hướng sau khi chỉnh sửa
                die();
            } else {
                echo "Chỉnh sửa thất bại";
            }
        } else {
            echo(""); // Giữ nguyên hoặc không thực hiện hành động khi biểu mẫu không được gửi
        }
    } else {
        die('Bạn không có quyền truy cập vào trang này <a href="home.php">Trang chủ</a>');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
        <div class="">
            <?php 
                $sql = "SELECT * FROM product WHERE id = $id";
                $result = mysqli_query($conn, $sql);
            ?>
            <table border="1">
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Describe</th>
                </tr>
                <?php 
                    $i = 1;
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><img src="<?php echo $row['img']; ?>" alt="" width="100px"></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['description']; ?></td>

                </tr>
                <?php 
                    $i++;
                    }
                ?>
            </table>
        </div>

    <div class="">
        <form action="" method="post" enctype="multipart/form-data">
                    <?php 
                        $sql = "SELECT * FROM product WHERE id = $id";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
 
                    ?> 
                    <div class="">
                        <h2>Edit product</h2>
                        <div>
                            <div class="">
                                <label for="name">Name</label>
                            </div>
                            <input type="text" name="name" id="name" placeholder="Enter your name" value="<?php echo $row['name']; ?>">
                        </div>
                        <div>
                            <div class="">
                                <label for="image">Image</label>
                            </div>
                            
                            <input type="file" name="img" id="img" value="<?php echo $row['img']; ?>">
                        </div>
                        <div>
                            <div class="">
                                <label for="price">Price</label>
                            </div>
                            <input type="text" name="price" id="price" placeholder="Enter your price" value="<?php echo $row['price']; ?>">
                        </div>
                        <div>
                            <div class="">
                                <label for="desc">Describe </label>
                            </div>
                            <textarea  type="text" name="desc" id="desc" placeholder="Enter your desc"  ><?php echo $row['description']; ?></textarea>
                        </div>
                        <div>
                            <button type="submit">Add +</button>
                        </div>
                    </div>
        </form>  
    </div>

</body>
</html>