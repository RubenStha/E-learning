<?php
include "../../connection.php";
    session_start();

    if(isset($_POST['submit']))
    {
        $user_name = $_POST['username'];
        $pwd = $_POST['password'];


        $sql ="SELECT * FROM `user` WHERE `username` = '$user_name' AND `password` = '$pwd'";
        $read = $connect->query($sql);
    
        if(mysqli_num_rows($read) > 0)
        {
            $_SESSION['user_login']='yes';
            $_SESSION['user_name']=$user_name;
            $data= $read->fetch_assoc();
            if($data['usertype'] == 'vendor')
            {
                header("Location: ../../Vendor/VendorPhp/productlist.php");
                exit();
            }
            else{
                header("Location: ../../Customer/CustomerPhp/index.php");
            exit();

            }
            
        }
        else{
            echo " username and password didnot match";
        }  
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../loginCss/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>Login Form</title>
</head>
<body>
    <div class="container">
        <div class="slideshow-container">
                <img src="ecom/img/card1.png" class="imgs" style="width:100%;height:80vh;object-fit:cover">
                
                <div style="text-align:center" class="dot-btn">
                    <span class="dot" onclick="currentSlide(1)"></span> 
                    <span class="dot" onclick="currentSlide(2)"></span> 
                    <span class="dot" onclick="currentSlide(3)"></span> 
                </div>

        </div>
        <form action="#" method="post" class="sign-in">
            <div class="welcome">
            <img src="ecom/img/light-logo.png" alt="" class="logo">
            <p class="welcome-msg">
                Welcome to clothing :)
            </p>
            </div>
            
            <div class="input">
                <input type="text" name="username" placeholder="User name" required class="in">
                <input type="password" name="password" placeholder="password" required class="in">
                <input type="submit" name="submit" class="in btn">
            </div>
        </form>
    </div>
    
</body>
</html>