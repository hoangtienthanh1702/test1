<?php

include "token.php";

if(isset($_SESSION['username']) && $_SESSION['username']){
    header("location:home.php");
}

if (isset($_POST['username']) && isset($_POST['password'])  ) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // check hash password
        if (md5($password) === $row['password']) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['roles'] = $row['roles'];
            $_SESSION['money'] = $row['money'];

            $username = $row['username'];
            $random_bytes = random_bytes(32);
            $token = bin2hex($random_bytes);  

            $sqlToken = "Update users set token = '$token' where username = '$username'";
            echo $sqlToken;
            mysqli_query($conn, $sqlToken);

            if(isset($_POST['remember'])){
                setcookie('username', $username, time() + 3600);
                setcookie('password', $password, time() + 3600);
                setcookie('token', $token, time() + 3600);
            }else{
                setcookie('username', '', time() - 3600);
                setcookie('password', '', time() - 3600);
            }
            
            header("Location: home.php");
            exit;
        } else {
            echo "Mật khẩu không đúng.";
        }
    } else {
        echo "Tên đăng nhập không đúng.";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <div>
        <a href="index.php">Trang chủ</a>
    </div>
    <div>
        <?php if(isset($_COOKIE['username']) && isset($_COOKIE['password'])): ?>
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Enter your username" value="<?php echo $_COOKIE['username'] ?>">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" value="<?php echo $_COOKIE['password'] ?>">
                </div>
                <div class="">
                    <input type="checkbox" name="remember" id="remember" checked>
                    <label for="remember">Remember me</label>
                </div>
                <div>
                    <button type="submit">Login</button>
                    <button type="">
                        <a href="register.php">Register</a>
                    </button>
                </div>
            </form>
        <?php else: ?>
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Enter your username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password">
                </div>
                <div class="">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                <div>
                    <button type="submit">Login</button>
                    <button type="">
                        <a href="register.php">Register</a>
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>

</body>
</html>
