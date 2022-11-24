<?php

include "../../connection.php";
session_start();
$vendor = $_SESSION['user_name'];

$sql = "SELECT * FROM getOrder INNER JOIN product ON getOrder.productId = product.productId AND getOrder.level < 4 AND product.vendor='$vendor'";
$result = $connect->query($sql) or die($connect->error);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../VendorCss/VendorProductlist.css">
    <title>Order List</title>
</head>

<body>
    <div class="body">
        <div class="nav"></div>
        <div class="hero">
            <div class="header">
                <h2>Order's List</h2>
            </div>
            <div class="search">
                <input type="text" style="margin-right:323px; width:40%; height:40px; padding:10px" id="productName" onkeyup="myfunction(2)" placeholder="Search for category">
                <select name="level" id="level" class="btn" onchange="myfunction(8)">
                    <option value="all" selected>Status</option>
                    <option onselect="myfuction()" value="Pending">Pending</option>
                    <option onselect="myfuction()" value="Confirm">Confirm</option>
                    <option onselect="myfuction()" value="Shipped">shipped</option>

                </select>

            </div>

            <table id="myTable">
                <tr>
                    <th>#ID</th>
                    <th>Customer Name</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>Delivery</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php
                while ($data = $result->fetch_assoc()) { ?>
                    <tr id="<?php $data["orderId"] ?>">
                        <td>
                            <input hidden type="number" class="productId" value="<?php echo $data['productId']; ?>">
                            <input hidden type="number" class="orderId" value="<?php echo $data['orderId']; ?>">
                            <?php echo $data['orderId']; ?>
                        </td>
                        <td class="user_name"><?php echo $data['customerName']; ?></td>
                        <td><?php echo $data['category']; ?></td>
                        <td><img style="height: 50px;" src="<?php echo $data['productImg']; ?>" alt=""></td>
                        <td class="qty"><?php echo $data['actualPrice']; ?></td>
                        <td><?php echo $data['orderQty']; ?></td>
                        <td><?php echo $data['size']; ?></td>
                        <td><?php echo $data['address']; ?></td>
                        <td class="level"><?php
                                            $level = array('pending', 'confirm', 'shipped', 'delivered');
                                            echo $level[$data['level'] - 1];
                                            ?></td>
                        <td> <input hidden class="status" type="number" value="<?php echo $data['level']; ?>"><button class="action-btn"><?php echo $level[$data['level']]; ?></button></td>
                    </tr>
                <?php } ?>

            </table>


        </div>
    </div>
    <script>
        var action_btn = document.getElementsByClassName('action-btn');
        var productId = document.getElementsByClassName('productId');
        var orderId = document.getElementsByClassName('orderId');
        var user = document.getElementsByClassName('user_name');
        var level = document.getElementsByClassName('status');
        for (var i = 0; i < action_btn.length; i++) {
            (function(index) {
                action_btn[i].onclick = function() {
                    console.log(orderId[index].value + " CustomerName " + user[index].innerHTML + "Status=" + level[index].value + " " + productId[index].value);
                    var xml = new XMLHttpRequest();
                    xml.open("GET", "updateStatus.php?oid=" + orderId[index].value + "&&user=" + user[index].innerHTML + "&&level=" + level[index].value + "&&pid=" + productId[index].value, true);
                    xml.onload = function() {
                        if (level[index].value == 3) {
                            orderId[index].parentElement.parentElement.style.display = "none";
                        }

                        var status = ['confirm', 'shipped', 'delivered'];
                        console.log(status[level[index].value - 1]);
                        console.log(document.getElementsByClassName('level')[index]);
                        document.getElementsByClassName('level')[index].innerHTML = status[level[index].value - 1];
                        action_btn[index].innerHTML = status[level[index].value];

                        level[index].value = parseInt(level[index].value) + 1;
                    }
                    xml.send();
                    // level[index].value = level[index].value + 1;
                }

            })(i);
        }

        function myfunction(value) {
            var input, filter, table, tr, td, i, txtValue, type;
            console.log(value);
            // console.log(document.getElementById("productName"));
            // console.log(document.getElementById("level").value);
            if (value == 2) {
                type = "search";
                input = document.getElementById("productName");
            } else if (value == 8) {
                type = "btn";
                input = document.getElementById("level");
            }

            filter = input.value.toUpperCase();
            console.log("filter", filter);
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");


            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {

                td = tr[i].getElementsByTagName("td")[value];

                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (type === "search" && txtValue.toUpperCase().indexOf(filter) > -1) {

                        tr[i].style.display = "";
                    } else if (type === "btn" && txtValue.toUpperCase() === filter.toUpperCase()) {

                        tr[i].style.display = "";
                    } else {

                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <script src="../VendorJs/nav.js"></script>

</body>

</html>