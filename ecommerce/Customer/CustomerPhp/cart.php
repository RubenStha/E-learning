<?php
session_start();
require_once('createdb.php');
include '../../connection.php';

$database = new CreateDb();
// $executeProduct = $database->getData('product');
$user = $_SESSION['user_name'];
$executeCart = $database->getJoinData($user);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Details</title>
    <link rel="stylesheet" href="../CustomerCss/CustomerHome.css">
</head>

<body>
    <nav class="navbar">
        <?php
        require_once "component.php";
        ?>
    </nav>

    <h2 id="item"></h2>
    <div>
        <table id="mytable">
            <tr>
                <th>Select</th>
                <th>SN#</th>
                <th>Product Name</th>
                <th>Brand</th>
                <th>Product Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php
            $i = $total = 0;

            while ($product = mysqli_fetch_assoc($executeCart)) {
                if ($_SESSION['user_name'] == $product['user_name']) {

            ?>
                    <tr class="row" id="<?php echo $product['productId']; ?>">
                        <td><input type="checkbox" class="select" value="<?php echo $product['productId']; ?> "></td>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $product['productName']; ?></td>
                        <td><?php echo $product['brand']; ?></td>
                        <td><span class="price"><?php echo $product['actualPrice']; ?></span></td>
                        <td><img src="<?php echo $product['productImg']; ?> " alt="" style="height: 100px;"></td>

                        <td>
                            <input hidden class="productId" type="number" value="<?php echo $product['productId']; ?>">
                            <input hidden class="mqty" type="number" value="<?php echo $product['qty']; ?>">
                            <button class="add">-</button>
                            <input type="number" id="qty" class="qty" name="cart_qty" value="<?php echo $product['cart_qty']; ?>">
                            <button class="add"> +</button>
                        </td>

                        <td><span class="total"><?php echo $product['actualPrice'] * $product['cart_qty']; ?></span></td>
                        <td><a href="removeitem.php?id=<?php echo $product['productId']; ?>">Remove</a></td>
                    </tr>
            <?php
                    $total = $total + $product['actualPrice'] * $product['cart_qty'];
                }
            }

            ?>
            <tr>
                <td>Grand Total =</td>
                <td><span id="grand_total"><?php echo $total ?></span></td>
            </tr>
        </table>

        <button id="checkout"> Check Out</button>


        <span id="msg"></span>

    </div>
    <did id="info"></did>
    <footer>
    </footer>

</body>
<script>
    var selectedId = [];
    var select = document.getElementsByClassName('select');
    var btn = document.getElementsByClassName('add');
    var pid = document.getElementsByClassName('productId');
    var qtyInput = document.getElementsByClassName('qty');
    var price = document.getElementsByClassName('price')
    var total = document.getElementsByClassName('total');
    var grand_total = document.getElementById('grand_total');
    var maxqty = document.getElementsByClassName('mqty');
    var checkout = document.getElementById('checkout');

    checkout.onclick = function() {
        console.log("clicked")
        if (selectedId.length == 0) {
            document.getElementById('msg').innerHTML = "NO items selected";
        } else {
            location.href = "checkout.php?selectedId= " + selectedId;

        }

    }

    for (var i = 0; i < btn.length; i++) {

        (function(index) {
            btn[i].onclick = function() {
                var qty;
                if (index == 0) {

                    row = 0;
                    qty = parseInt(qtyInput[row].value) - 1;

                } else if (index % 2 == 0) {
                    row = index / 2;
                    qty = parseInt(qtyInput[row].value) - 1;
                } else {
                    row = (index - 1) / 2;
                    qty = parseInt(qtyInput[row].value) + 1;
                }
                var mqty = maxqty[row].value;
                if (qty > mqty) {
                    qty = mqty;
                    alert("out of stock")
                }
                if (qty < 1) {
                    qty = 1;
                    alert("Quantity cannot be less than 1")
                }
                var productID = pid[row].value;
                var productPrice = price[row].innerHTML;

                // alert(row + " " + qty + "  " + productID + "   " + productPrice)
                var xml = new XMLHttpRequest();
                xml.open("GET", "updateqty.php?pid=" + productID + "&&qty=" + qty, true);
                xml.onload = function() {
                    if (this.status == 200) {

                        qtyInput[row].value = this.responseText;

                        total[row].innerHTML = this.responseText * productPrice;
                        console.log("total", total[row].innerHTML);
                        var Gtotal = 0;
                        for (i = 0; i < total.length; i++) {
                            Gtotal = Gtotal + parseInt(total[i].innerHTML);
                            grand_total.innerHTML = Gtotal;


                        }

                    }
                }
                xml.send();

            }
        })(i);
    }
    for (var i = 0; i < pid.length; i++) {

        (function(index) {

            select[i].onclick = function() {

                var productID = parseInt(pid[index].value);
                if (select[index].checked == true) {
                    selectedId.push(productID);
                } else {
                    var ClickedId = select[index].value;
                    var clickedLocation = selectedId.indexOf(parseInt(ClickedId));
                    selectedId.splice(clickedLocation, 1);
                }

            }
        })(i);
    }
</script>

<script src="../CustomerJs/CustomerFooter.js"></script>


</html>