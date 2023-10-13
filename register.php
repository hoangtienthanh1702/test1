<?php
   include "connect.php";

    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['re-password']) && isset($_POST['name'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['re-password'];
        $name = $_POST['name'];
        $money = 500;
        $roles = "user";

        // Validate thông tin
        if (empty($username) || empty($password) || empty($name) || empty($repassword)) {
            echo "Bạn vui lòng nhập đầy đủ thông tin.";
        } else if (strlen($username) < 5 || strlen($password) < 5) {
            echo "Tên đăng nhập và mật khẩu phải có ít nhất 5 ký tự.";
        } else if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{5,}$/", $password)) {
            echo "Mật khẩu phải có ít nhất 5 ký tự, 1 chữ hoa, 1 chữ thường và 1 số.";
        } else if ($password != $repassword) {
            echo "Mật khẩu không trùng khớp.";
        } else {
            // Kiểm tra xem username đã tồn tại trong cơ sở dữ liệu hay chưa
            $check_username_sql = "SELECT * FROM users WHERE username = '$username'";
            $check_username_result = mysqli_query($conn, $check_username_sql);

            if (mysqli_num_rows($check_username_result) > 0) {
                echo "Tên đăng nhập này đã tồn tại. Vui lòng chọn tên đăng nhập khác.";
            } else {
                // Mã hóa mật khẩu
                $hashed_password = md5($password);

                // Câu lệnh SQL để thêm người dùng
                $insert_sql = "INSERT INTO users (name, username, password, roles , money) VALUES ('$name', '$username', '$hashed_password', '$roles' , '$money')";
                $insert_result = mysqli_query($conn, $insert_sql);

                if ($insert_result) {
                    echo "Đăng ký thành công!";
                    header("Location: login.php");
                } else {
                    echo "Đăng ký thất bại.";
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <div>
        <a href="index.php">Trang chủ</a>
    </div>
    <div>
        <form action="" method="post">
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Nhập tên của bạn">
            </div>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Nhập tên đăng nhập (ít nhất 5 ký tự)">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Nhập mật khẩu (ít nhất 5 ký tự)">
            </div>
            <div>
                <label for="re-password">Re-Password</label>
                <input type="password" name="re-password" id="re-password" placeholder="Nhập lại mật khẩu">
            </div>
            <div>
                <button type="submit">Đăng ký</button>
                <button type="button">
                    <a href="login.php">Đăng nhập</a>
                </button>
            </div>
        </form>
    </div>
</body>
</html>
