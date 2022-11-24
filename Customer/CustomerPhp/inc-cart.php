<?php
include '../../connection.php';
if (isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];
    $cartItems = "SELECT * FROM `cart` WHERE `user_name`= '$user'";

    $executeCart = $connect->query($cartItems);
    $cartItem = mysqli_num_rows($executeCart);
    $_SESSION['items'] = $cartItem;
}
if (isset($_POST['addtocart'])) {
    if (!isset($_SESSION['user_login'])) {
        header("location: ../../login/LoginPhp/login.php");
    }
    $productId = $_POST['productId'];
    $size = $_POST['size'];

    $quantity = $_POST["quantity"];
    $sql = "SELECT `qty` FROM `product` WHERE `productId`= '$productId'";
    $executeQty = $connect->query($sql);
    $maxQty = mysqli_fetch_assoc($executeQty);

    if ($quantity < 1) {
        $quantity = 1;
    }
    if ($quantity > $maxQty['qty']) {
        $quantity = $maxQty['qty'];
    }
    $i = 0;
    while ($data = $executeCart->fetch_assoc()) {
        if ($productId == $data['productId']) {
            $sql = "UPDATE `cart` SET `size`='$size',`cart_qty`='$quantity' WHERE `user_name`= '$user' && `productId`='$productId'";
            $connect->query($sql);
            break;
        }
        $i++;
    }
    if ($cartItem == $i) {
        $sql = "INSERT INTO `cart`(`user_name`, `productId`, `cart_qty`, `size`) VALUES ('$user','$productId','$quantity','$size')";
        if ($connect->query($sql) === TRUE) {
            header("location: index.php");
            echo "   add to cart";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
}
