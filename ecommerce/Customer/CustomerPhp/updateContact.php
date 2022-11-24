<?php
session_start();
require "../../connection.php";
$user = $_SESSION['user_name'];
if (isset($_GET['data']) && isset($_GET['type'])) {
    $data = $_GET['data'];
    $type = $_GET['type'];
    $sql = "UPDATE `customer` SET `$type`='$data' WHERE `username`='$user'";
    if ($connect->query($sql)) {
        echo $data;
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
}
