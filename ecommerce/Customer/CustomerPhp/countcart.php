<?php
include '../../connection.php';
$cartItem;
if (isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];
    $sql = "SELECT * `cart` WHERE `user_name`='$user'";
    if ($result = $connect->query($sql)) {
        if (!$cartItem = mysqli_num_rows($result) > 0) {
            $cartItem = 0;
        }
    }
}
