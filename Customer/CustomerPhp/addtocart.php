<?php
session_start();
include '../../connection.php';


if (isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];
    $cartItems = "SELECT * FROM `cart` WHERE `user_name`= '$user' ";
    $executeCart = $connect->query($cartItems);
    $cartItem = mysqli_num_rows($executeCart);

    if (isset($_GET['pid'])) {
        $productId = $_GET['pid'];
        $i = 0;
        while ($data = $executeCart->fetch_assoc()) {
            if ($productId == $data['productId']) {
                $qty = $data['cart_qty'];
                $sql = "SELECT `qty` FROM `product` WHERE `productId`= '$productId'";
                $executeQty = $connect->query($sql);
                $maxQty = mysqli_fetch_assoc($executeQty);
                $qty = $qty + 1;
                if ($qty > $maxQty['qty']) {
                    $qty = $maxQty['qty'];
                }

                $sql = "UPDATE `cart` SET `cart_qty`='$qty' WHERE `user_name`= '$user' && `productId`='$productId'";
                $connect->query($sql);
                echo $cartItem;
                break;
            }
            $i++;
        }
        if ($cartItem == $i) {
            $sql = "INSERT INTO `cart`(`user_name`, `productId`, `cart_qty`, `color`, `size`) VALUES ('$user','$productId','1','red','xl')";
            if ($connect->query($sql) === TRUE) {
                $_SESSION['items'] = $cartItem + 1;
                echo $cartItem + 1;
            } else {
                echo "Error: " . $sql . "<br>" . $connect->error;
            }
        }
    }
} else {
    header("location: http://localhost/ecommerce/login/LoginPhp/login.php");
}
