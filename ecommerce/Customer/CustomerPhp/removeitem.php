<?php
    include "../../connection.php";
     session_start(); 
     --$_SESSION['items'];
    $user=$_SESSION['user_name'];

    if($_GET['id'])
    {
        $id = $_GET['id'];
    }
     $sql = "DELETE FROM `cart` WHERE `productId` = '$id' AND `user_name`= '$user'";
         

        if($connect->query($sql))
        {
            echo "remove successfully";
             header("location: cart.php");
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
?>