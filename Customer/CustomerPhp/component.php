<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/nav.css">
    <title>Document</title>
</head>

<body>
    <div class="nav">
        <a href="index.php"><img src="../img/dark-logo.png" class="brand-logo" alt="image of logo"></a>
        <div class="nav-item">
            <div class="search">
                <input type="text" class="search-box" placeholder="search brand, product">
                <button class="search-btn">Search</button>
            </div>

            <?php
            if (isset($_SESSION['user_login']) && $_SESSION['user_login'] != '') {
                echo $_SESSION['user_name']
            ?>
                <a href=""><img src="../img/user.png" alt=""></a>
                <button><a href="../../login/loginPhp/logout.php">logout</a></button>


            <?php
            } else { ?>
                <a href="../../login/loginPhp/login.php">Log in</a>
                <a href="../../login/loginPhp/register.php">Register</a>
            <?php
            } ?>

            <a href="cart.php"><img src="../img/cart.png" alt=""></a>
            <?php
            if (isset($_SESSION['items'])) {
                $cartItem = $_SESSION['items'];
                echo "<span id='item'>$cartItem</span>";
            } else {
                echo "<span>0</span>";
            }
            ?>
        </div>

    </div>
    <ul class="links-container">
        <li class="link-item"><a href="#" class="link">Home</a></li>
        <li class="link-item"><a href="#" class="link">Women</a></li>
        <li class="link-item"><a href="#" class="link">Men</a></li>
        <li class="link-item"><a href="#" class="link">Kid</a></li>
        <li class="link-item"><a href="#" class="link">Accessories</a></li>
    </ul>


</body>

</html>