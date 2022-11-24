<?php
session_start();
include "../../connection.php";
if (isset($_GET['oid']) && isset($_GET['user']) && isset($_GET['level']) && isset($_GET['pid'])) {
    $user = $_GET['user'];
    $orderId = $_GET['oid'];
    $id = $_GET['pid'];
    $level = $_GET['level'] + 1;

    if ($level == 4) {
        $sql = "SELECT * FROM `getOrder` WHERE `productId`='$id'";
        $execute = $connect->query($sql) or die($connect->error);
        $data = $execute->fetch_assoc();

        $quantity = $data['orderQty'];

        $sql = "UPDATE `product` SET `qty`=`qty`- $quantity WHERE `productId` ='$id'";
        $execute = $connect->query($sql);
    }

    $sql = "UPDATE `getorder` SET `level`='$level' WHERE `orderId`='$orderId' AND `customerName`='$user '";
    $result = $connect->query($sql) or die($connect->error);
}
