<?php
// Bao gồm tệp kết nối cơ sở dữ liệu
include "connect.php";

// Bắt đầu phiên PHP
session_start();

// Kiểm tra xem người dùng có vai trò 'admin' trong phiên của họ hay không
if ($_SESSION['roles'] == "admin" || $_SESSION['roles'] == "owner") {
    // Hiển thị thông báo cho bảng điều khiển admin
    echo '<a href="home.php">Home</a>';
    echo '</br>';
    echo '<a href="addproduct.php">Them san pham</a>';
    echo '</br>';
    if($_SESSION['roles'] == "admin") {
        echo '<a href="admin.php">Quan ly user</a>'; 
        echo '</br>';
    }
    echo '<a href="manage_order.php">Quản lý đơn hàng</a>';

    // Kiểm tra xem dữ liệu biểu mẫu để thêm sản phẩm đã được gửi
    if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['desc']) && isset($_FILES["img"]["name"])) {
        // Lấy dữ liệu từ biểu mẫu
        $name = $_POST['name'];
        $price = $_POST['price']; 
        $desc = $_POST['desc'];

        // Upload file
        $targer_dir = "uploads/";

        $targer_basename = basename($_FILES["img"]["name"]);
        $target_file = $targer_dir . $targer_basename;
        $img = $target_file;

        if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)){
            echo "hình ảnh đã được tải lên";
        } else{
            echo "Có lỗi khi tải hình ảnh lên";
        }   


        // Chèn dữ liệu sản phẩm vào cơ sở dữ liệu
        $sql = "INSERT INTO product (name, img, price, description) VALUES ('$name', '$img', '$price', '$desc')";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            echo "~~~~~~~~~ Thêm thành công ~~~~~~~~~";
            // Chuyển hướng đến trang addproduct.php
            header("Location: addproduct.php");
        } else {
            echo "Thêm thất bại";
        }
    } else {
        echo(""); // Giữ nguyên hoặc không thực hiện hành động khi biểu mẫu không được gửi
    }
} else {
    // Hiển thị thông báo lỗi nếu người dùng không có quyền admin
    die('Bạn không có quyền truy cập vào trang này <a href="home.php">Trang chủ</a>');
}
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
            <h3>Add product</h3>
            <form action="" method="post"  enctype="multipart/form-data">
                <div>
                    <div class="">
                        <label for="name">Name</label>
                    </div>
                    <input type="text" name="name" id="name" placeholder="Enter your name">
                </div>
                <div>
                    <div class="">
                        <label for="image">Image</label>
                    </div>
                    <input type="file" name="img" id="img">
                </div>
                <div>
                    <div class="">
                        <label for="price">Price</label>
                    </div>
                    <input type="text" name="price" id="price" placeholder="Enter your price">
                </div>
                <div>
                    <div class="">
                        <label for="desc">Describe </label>
                    </div>
                    <textarea  type="text" name="desc" id="desc" placeholder="Enter your desc" ></textarea>
                </div>
                <div>
                    <button type="submit">Add +</button>
                </div>
            </form>
        </div>
        <div class="">
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
                    <th>Describe</th>
                    <th>Action</th>
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
                    <td>
                        <a href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="delete_product.php?id=<?php echo $row['id']; ?>">Delete</a>
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