<?php
include "../../connection.php";
session_start();
$vendor = $_SESSION['user_name'];
$sql
    = "SELECT * FROM getOrder INNER JOIN product ON getOrder.productId = product.productId AND getOrder.level=4 AND product.vendor='$vendor' ORDER BY getOrder.orderId asc;";

$result = $connect->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../VendorCss/VendorProductlist.css">
    <title>Transcation</title>
</head>

<body>
    <div class="body">
        <div class="nav"></div>
        <div class="hero">
            <div class="header">
                <h2>Transcation List</h2>
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
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php while ($data = $result->fetch_assoc()) { ?>

                    <tr>
                        <td class="productId"><?php echo $data['orderId']; ?></td>
                        <td class="user_name"><?php echo $data['customerName']; ?></td>
                        <td><?php echo $data['category']; ?></td>
                        <td><img style="height: 50px;" src="<?php echo $data['productImg']; ?>" alt=""></td>
                        <td><?php echo $data['actualPrice']; ?></td>
                        <td><?php echo $data['qty']; ?></td>
                        <td><?php echo $data['size']; ?></td>
                        <td class="level"><?php
                                            $level = array('pending', 'confirm', 'shipped', 'delivered');
                                            echo $level[$data['level'] - 1];
                                            ?></td>
                        <td> <input hidden class="status" type="number" value="<?php echo $data['level']; ?>"><button class="action-btn">complete</button></td>
                    </tr>
                <?php } ?>

            </table>


        </div>
    </div>

</body>
<script src="../VendorJs/nav.js"></script>

</html>