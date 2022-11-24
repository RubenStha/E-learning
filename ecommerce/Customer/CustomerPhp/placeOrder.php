<?php
require "../../connection.php";
session_start();
$user = $_SESSION['user_name'];

if (isset($_GET['selectedId']) && isset($_GET['address'])) {
    $selectedId = trim($_GET['selectedId'], " ");
    $selectedId = explode(",", $selectedId);
    $address = $_GET['address'];
    // $_SESSION['items'] =  sizeof($selectedId);
    foreach ($selectedId as $id) {
        // echo $id . " ";
        // $sql = "UPDATE `product` SET `qty`=`qty`- $quantity WHERE `productId` ='$id'";
        $sql = "SELECT `cart_qty`,  `size` FROM `cart` WHERE `productId`='$id'";
        $execute = $connect->query($sql);
        $cart = mysqli_fetch_assoc($execute);
        // echo $cart;

        $quantity = $cart['cart_qty'];
        $size = $cart['size'];

        $sql = "INSERT INTO `getOrder`(`customerName`, `productId`, `orderQty`, `size`,`address`) VALUES ('$user','$id','$quantity','$size','$address')";
        $execute = $connect->query($sql) or die($connect->error);

        $sql = "DELETE FROM `cart` WHERE `productId`='$id' && `user_name`='$user'";
        if ($execute = $connect->query($sql)) {
            // echo $_SESSION['items'];
        }
    }
}
