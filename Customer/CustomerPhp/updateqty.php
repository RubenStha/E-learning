<?php
session_start();
include "../../connection.php";
if (isset($_GET['pid']) && isset($_GET['qty'])) {
    $productId = $_GET['pid'];
    $qty = $_GET['qty'];
    $user = $_SESSION['user_name'];

    // echo $productId . " " . $qty . " " . $user;

    $sql = "UPDATE `cart` SET `cart_qty`='$qty' WHERE `productId` ='$productId' && `user_name`='$user'";
    if ($connect->query($sql)) {
        echo $qty;
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
}
