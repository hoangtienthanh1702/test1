<?php 
    include_once "connect.php";
    if(isset($_POST['name_product']) && isset($_POST['number'])){
        $name_product = $_POST['name_product'];
        $number = $_POST['number'];
        $sql = "INSERT INTO product (name_product,number ) VALUES ('$name_product', '$number')";
        $result = mysqli_query($conn, $sql);
        // echo $sql;
        if($result){
            echo "~~~~~~~~~ Add successfully ~~~~~~~~~";
        }else{
            echo "Add failed";
        }
    }else{
        echo("demo") ;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>san pham</title>
</head>
<body>
    <div class="">
        <a href="index.php">trang chu</a>
        <a href="home.php">home</a>
    </div>
    <!-- add product -->
    <div class="">
        <form action="" method="post">
            <div>
                <label for="name_product">Choose a gemstone:</label>
                    <select id="name_product" name="name_product" size="3">
                        <option value="amber">amber</option>
                        <option value="amethyst">amethyst</option>
                        <option value="aquamarine">aquamarine</option>
                        <option value="saphire">saphire</option>
                    </select>
            </div>
            <div class="">
                <label for="number">Number</label>
                <input type="number" name="number" id="number" placeholder="Enter your number">
            </div>
            <div>
                <button type="submit">Add</button>
            </div>
        </form>
    </div>

    <!--  product -->
    <div class="">
        <?php 
            $sql = "SELECT * FROM product";
            $result = mysqli_query($conn, $sql);
            echo(mysqli_num_rows($result) . "<br>");
        ?>
        <table border="1">
            <tr>
                <th>id</th>
                <th>name_product</th>
                <th>number</th>
                <th>action</th>
            </tr>
            <?php
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name_product'] . "</td>";
                    echo "<td>" . $row['number'] . "</td>";
                    echo "<td><a href='edit_product.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete_cart.php?id=" . $row['id'] . "'>Delete</a></td>";
                    echo "</tr>";
                }
            }else{
                echo "0 results";
            }
            ?>
    </div>
</body>
</html>