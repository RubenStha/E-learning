<?php

include "../../connection.php";
session_start();
$vendor = $_SESSION['user_name'];

$sql = "SELECT  getOrder.productId, product.productName, product.productImg, product.actualPrice , sum(getOrder.orderQty) as qty FROM getOrder INNER JOIN product  ON getOrder.productId = product.productId AND getOrder.level = 4 AND product.vendor='$vendor' group by product.productId";
$result = $connect->query($sql) or die($connect->error);





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../VendorCss/VendorProductlist.css">
    <title>Sales Report</title>
</head>

<body>
    <div class="body">
        <div class="nav"></div>
        <div class="hero">
            <div class="header">
                <h2>Order's List</h2>
            </div>
            <div class="search">
                <input type="text" style="margin-right:323px; width:40%; height:40px; padding:10px" id="productName" onkeyup="myfunction(1)" placeholder="Search for product Name">
            </div>

            <table id="myTable">
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Sales</th>
                    <th>Income</th>
                </tr>

                <?php
                $income = 0;
                while ($data = $result->fetch_assoc()) { ?>
                    <tr id="<?php echo $data['productId']; ?>">
                        <td>
                            <?php echo $data['productId']; ?>
                        </td>
                        <td class="productName"><?php echo $data['productName']; ?></td>
                        <td><img style="height: 50px;" src="<?php echo $data['productImg']; ?>" alt=""></td>
                        <td class="qty"><?php echo $data['actualPrice']; ?></td>
                        <td><?php echo $data['qty']; ?></td>
                        <td><?php $income = $income + ($data['qty'] * $data['actualPrice']);
                            echo $data['qty'] * $data['actualPrice']; ?></td>

                    </tr>
                <?php } ?>

            </table>
            <div class="income" style="text-align:end; padding-right:63px">
                Total Income:
                <?php
                echo "Rs" . $income;
                ?>
            </div>


        </div>
    </div>

</body>
<script src="../VendorJs/nav.js"></script>
<script>
    function myfunction(value) {
        var input, filter, table, tr, td, i, txtValue, type;
        console.log(value);
        // console.log(document.getElementById("productName"));
        // console.log(document.getElementById("level").value);
        if (value == 1) {
            type = "search";
            input = document.getElementById("productName");
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
                } else {

                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

</html>