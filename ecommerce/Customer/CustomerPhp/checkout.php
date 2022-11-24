<?php
session_start();

include '../../connection.php';

// $database = new CreateDb();
// $executeProduct = $database->getData('product');
$user = $_SESSION['user_name'];
if (isset($_GET['selectedId'])) {
    $selectedId = $_GET['selectedId'];
    $sql = "SELECT * FROM cart  INNER JOIN product ON cart.productId=product.productId AND cart.productId  in ($selectedId) ";
    $execute = $connect->query($sql);
    // $selectedId = explode(",", $selectedId);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CustomerCss/CustomerHome.css">
    <link rel="stylesheet" href="../CustomerCss/CustomerCheckout.css">
    <title>Product Checkout</title>
</head>

<body>
    <nav class="navbar">
        <?php
        require_once "component.php";
        ?>
    </nav>
    <div class="checkout">
        <div class="checkout-list">
            <table id="mytable">
                <tr>
                    <th>SN#</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Product Image</th>
                    <th>Total</th>
                </tr>
                <?php
                $i = $total = 0;

                while ($product = mysqli_fetch_assoc($execute)) {
                    if ($_SESSION['user_name'] == $product['user_name']) {

                ?>
                        <tr class="row" id="<?php echo $product['productId']; ?>">
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $product['productName']; ?></td>
                            <td><?php echo $product['brand']; ?></td>
                            <td><img src="<?php echo $product['productImg']; ?> " alt="" style="height: 100px;"></td>
                            <td><span class="total">Rs <?php echo $product['actualPrice'] * $product['cart_qty']; ?></span></td>

                        </tr>
                <?php
                        $total = $total + $product['actualPrice'] * $product['cart_qty'];
                    }
                }
                // }
                $sql = "SELECT * FROM `customer` WHERE `username`='$user'";
                $execute = $connect->query($sql);



                ?>
            </table>

        </div>
        <div class="order-summary">
            <?php $customer = mysqli_fetch_assoc($execute); ?>
            <p class="shipping-title">
                Shipping Address
            </p>
            <p>
                <textarea id="address" name="address" rows="4" cols="50" placeholder="Enter the Delivery Location "></textarea>
            </p>
            <p id="contact">
                <span id="num1"><?php echo $customer['contact']; ?> </span><button class="edit" onclick="update(0);">Edit</button>
            </p>
            <p id="contact-upt">
                <input type="number" id="num2" value="<?php echo $customer['contact']; ?>">
                <button onclick="update(1)">UPDATE</button>
            </p>
            <p id="email">
                <span id="upmail"> <?php echo $customer['email']; ?></span>
                <button class="edit" onclick="update(2)">Edit</button>
            </p>
            <p id="email-upt">
                <input type="email" id="mail" value="<?php echo $customer['email']; ?>">
                <button onclick="update(3)">UPDATE</button>
            </p>
            <p class="shipping-title">
                Order Summary
            </p>
            <p>
                payment <span>Cash of Delivery</span>
            </p>
            <p class="subtotal">
                Subtotal <span id="grand_total">Rs &nbsp<?php echo $total ?></span>
            </p>
            <p class="shipping-fee">
                Shipping Fee <span id="shipping">Rs &nbsp<?php echo 60 * $i;  ?></span>
            </p>
            <p class="total">
                total <span id="total">Rs &nbsp<?php echo (60 * $i) + $total;  ?></span>
            </p>
            <p>
            <div id="ids" style="display:none;"><?php print_r($selectedId); ?></div>
            <button id="confirm" style="width: 100%;" onclick="placeOrder();">Proccess</button>
            </p>

        </div>
    </div>
    <div id="Confirmation-msg">
        <h2 style="text-align:center; margin-bottom:30px;">Order Successful</h2>
        <button onclick="goToHome();">acknowledge</button>

    </div>
    <footer>
    </footer>
    <script src="../CustomerJs/CustomerFooter.js"></script>
    <script>
        contact = document.getElementById('contact');
        contact_upt = document.getElementById('contact-upt');
        email = document.getElementById('email');
        email_upt = document.getElementById('email-upt');
        num2 = document.getElementById('num2');
        mail = document.getElementById('mail');

        function placeOrder() {
            document.querySelector("#Confirmation-msg").style.display = 'block';
            address = document.querySelector("#address").value;
            ids = document.querySelector("#ids").innerHTML;

            var xml = new XMLHttpRequest();
            xml.open("GET", "placeOrder.php?selectedId=" + ids + "&&address=" + address, true);
            xml.onload = function() {
                if (this.status == 200) {
                    document.getElementById('item').innerHTML = this.responseText;
                    console.log(this.responseText);

                }

            }
            xml.send();
        }

        function goToHome() {
            location.href = "index.php";
        }

        function update(value) {
            if (value == 0) {
                contact.style.display = "none";
                contact_upt.style.display = "flex";

            }
            if (value == 1) {

                updateContact(num2.value, 'contact');

            }
            if (value == 2) {
                email.style.display = "none";
                email_upt.style.display = "flex";

            }
            if (value == 3) {
                updateContact(mail.value, 'email');

            }

        }

        function updateContact(data, type) {
            var xml = new XMLHttpRequest();
            xml.open("GET", "updateContact.php?data=" + data + "&&type=" + type, true);
            xml.onload = function() {
                if (this.status == 200) {
                    if (type == 'email') {
                        document.getElementById('upmail').innerHTML = this.responseText;
                        email_upt.style.display = "none";
                        email.style.display = "flex";
                    } else {
                        document.getElementById('num1').innerHTML = this.responseText;
                        contact_upt.style.display = "none";
                        contact.style.display = "flex";
                    }
                    console.log(this.responseText);

                }

            }
            xml.send();

        }
    </script>
</body>

</html>