<?php
session_start();
require_once('createdb.php');
include '../../connection.php';
$database = new CreateDb();
// $execute = $database->getData('product');

// $createCartTable = $database->createCartTable('cart');
$cartItem = 0;

if (isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];
    $cartItems = "SELECT * FROM `cart` WHERE `user_name`= '$user'";
    $executeCart = $connect->query($cartItems);
    $cartItem = mysqli_num_rows($executeCart);
    $_SESSION['items'] = $cartItem;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CustomerCss/CustomerHome.css">
    <script src="getid.js" asyn></script>
    <title>clothing</title>
</head>

<body>

    <nav class="navbar">
        <?php
        require_once "component.php";
        ?>
    </nav>

    <header class="hero-section">

        <div class="content">
            <img src="img/light-logo.png" class="light-logo" alt="">
            <p class="sub-heading">best fashion collection of all time</p>
        </div>
    </header>
    <section class="product best-sales">
        <h2 class="product-category">Best Sales</h2>
        <div class="product-container">
            <?php
            $sql = "SELECT * FROM `product` where qty>0";
            $execute = $connect->query($sql);
            $xyz = 0;
            while ($product = $execute->fetch_assoc()) {
            ?>
                <div class="product-card">
                    <a href="viewproduct.php?id=<?php echo $product['productId']; ?>">
                        <div class="product-img">
                            <span class="discount-tag">Stocks: &nbsp <?php echo $product['qty']; ?></span>
                            <!-- <?php echo $product['productImg']; ?> -->
                            <img src="<?php echo $product['productImg']; ?>" class="product-thumb" alt="">

                            <input type="text" name="productId" class="productId" value="<?php echo $product['productId']; ?>" hidden>

                        </div>
                        <div class="product-info">
                            <h2 class="product-brand"> <?php echo $product['productName']; ?></h2>
                            <p class="short-info">
                                <?php echo $product['productName']; ?>
                            </p>
                            <span class="price"><?php echo $product['actualPrice']; ?>
                            </span>
                            <span class="actual-price"><?php echo $product['actualPrice']; ?></span>
                        </div>
                    </a>
                    <button class="cart-btn">Add to Cart</button>
                </div>
                <!-- </form> -->
            <?php

            } ?>
        </div>
    </section>
    <section class="collection-container">
        <a href="#" class="collection">
            <img src="../img/women-collection.png" alt="">
            <p class="collection-tittle">Women</p>
        </a>
        <a href="#" class="collection">
            <img src="../img/men-collection.png" alt="">
            <p class="collection-tittle">men</p>
        </a>
        <a href="#" class="collection">
            <img src="../img/accessories-collection.png" alt="">
            <p class="collection-tittle">Accessories</p>

        </a>
    </section>
    <section class="product shoes">
    </section>
    <section class="product shirts">
    </section>
    <footer>
    </footer>
    <script src="../CustomerJs/CustomerFooter.js"></script>
    <script src="../CustomerJs/CustomerHome.js"></script>
</body>
<script>
    var product = document.getElementsByClassName('productId');
    var btn = document.getElementsByClassName('cart-btn');

    for (var i = 0; i < btn.length; i++) {
        (function(index) {
            btn[i].onclick = function() {

                var pid = product[index].value;
                alert("Product Added to Cart")
                var xml = new XMLHttpRequest();
                xml.open("GET", "addtocart.php?pid=" + pid, true);
                xml.onload = function() {

                    document.getElementById('item').innerHTML = this.responseText;
                    console.log(this.responseText);

                }
                xml.send();

            }
        })(i);
    }
</script>

</html>