<?php
include '../../connection.php';

session_start();
$product_id = $_GET['id'];
$sql1 = "SELECT * FROM `product` WHERE `productId`= '$product_id'";
$result1 = $connect->query($sql1);

require_once "inc-cart.php";

?>
<link rel="stylesheet" href="../CustomerCss/CustomerHome.css">
<link rel="stylesheet" href="../CustomerCss/CustomerProduct.css">

<body>
    <nav class="navbar">
        <?php
        require_once "component.php";
        ?>
    </nav>
    <?php
    if ($rows = $result1->fetch_assoc()) {
    ?>
        <section class="product-details">

            <img src="<?php echo $rows['productImg']; ?>" class="active" alt="">

            <div class="details">
                <h2 class="product-brand"><?php echo $rows['productName'] ?></h2>
                <p class="product-short-des"><?php echo $rows['shortDes'] ?></p>
                <div class="price">
                    <span class="product-price"><?php echo $rows['mrk'] ?></span>
                    <span class="product-actual-price"><?php echo $rows['actualPrice'] ?></span>
                    <span class="product-discount">( 50% off)</span>
                </div>
                <form action="" method="POST">
                    <input type="text" name="productId" value="<?php echo $rows['productId']; ?>" hidden>
                    <input type="text" name="vendor" value="<?php echo $rows['vendor']; ?>" hidden>
                    <p class="product-sub-heading">Select size</p>

                    <input type="radio" name="size" class="size" value="s" hidden id="s" checked>
                    <label for="s" class="size-radio-btn check" onclick="selectSize('s',0)">s</label>
                    <input type="radio" name="size" class="size" value="m" hidden id="m">
                    <label for="m" class="size-radio-btn" onclick="selectSize('m',1)">m</label>
                    <input type="radio" name="size" class="size" value="l" hidden id="l">
                    <label for="l" class="size-radio-btn" onclick="selectSize('l',2)">l</label>
                    <input type="radio" name="size" class="size" value="xl" hidden id="xl">
                    <label for="xl" class="size-radio-btn" onclick="selectSize('xl',3)">xl</label>
                    <br>
                    <input type="number" hidden id="remainingQty" value=<?php echo $rows['qty']; ?>>
                    <label for="quantity" class="btn" style="margin-right:20px;text-align:left;">
                        Quantity: <input type="number" id="qty" onchange="setLimit()" value=1 name="quantity" style="width:30px;height:30px;text-align:center;padding-top:10px;">
                    </label>
                    <span id='message'></span>
                    <button name="addtocart" class="btn btn-cart">Add to cart</button>
                </form>
            </div>
        </section>
        <section class="detail-des">
            <h2 class="heading">Description</h2>
            <p class="des">
                <?php echo $rows['longDes'] ?>
            </p>
        </section>
    <?php } ?>
    <footer></footer>
    <script src="../CustomerJs/CustomerFooter.js"></script>
    <script>
        function selectSize(s, i) {
            var btn = document.getElementsByClassName("size-radio-btn");
            var size = document.getElementsByClassName('size').value = s;

            for (a = 0; a < btn.length; a++) {
                btn[a].style.cssText = 'background:white; color:black';
            }
            console.log(document.getElementsByClassName("size-radio-btn")[i]);
            btn[i].style.cssText = 'background:#383838; color:white;';
            console.log(size)
        }

        function setLimit() {
            var x = document.getElementById('qty').value;
            var y = document.getElementById('remainingQty').value;
            var m = document.getElementById('message');
            if (x <= 0) {
                x = 1;
                m.style.color = 'red';
                m.innerHTML = 'quantity cannot be less than 1';
            } else if (x > y) {
                x = y;
                m.style.color = 'red';
                m.innerHTML = 'out of stock';
            } else {
                m.innerHTML = '';
            }
            console.log(x);
        }
    </script>

</body>