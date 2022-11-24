<?php
session_start();
$user = $_SESSION['user_name'];
include '../../connection.php';
$sql = "SELECT * FROM `categories`";
$result = $connect->query($sql);

$sql1 = "SELECT * from `product` WHERE `vendor`='$user'";
$result1 = $connect->query($sql1);

if (isset($_GET['type'])) {
    $type = $_GET['type'];
    if ($type == 'status') {
        $operation = $_GET['operation'];
        $id = $_GET['id'];

        if ($operation == 'active') {
            $status = 1;
        } else {
            $status = 0;
        }
        $update = "UPDATE `product` SET `status`='$status' WHERE `productId` = '$id'";
        $run = $connect->query($update);
    }
    header("location:productlist.php");
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product View</title>
    <link rel="stylesheet" href="../VendorCss/VendorProductlist.css">
</head>

<body>
    <div class="body">
        <div class="nav">
            <script src="../VendorJs/nav.js"></script>
        </div>
        <div class="hero">
            <div class="header">
                <h2>Product's List</h2>
                <button class="btn"><a href="addproduct.php" class="add-product">Create Product</a></button>
            </div>
            <div class="search">
                <input type="text" style="margin-right:323px; width:40%; height:40px; padding:10px" id="productName" onkeyup="myfunction(1)" placeholder="Search for product Name">
                <select name="category" id="category" class="btn" onchange="myfunction(2)">
                    <option value="category">Category</option>
                    <?php while ($rows = $result->fetch_assoc()) { ?>
                        <option value="<?php echo $rows['category_name']; ?>" class="opt"><?php echo $rows['category_name']; ?></option>
                    <?php } ?>
                </select>
                <select name="status" id="status" class="btn" onchange="myfunction(6)">
                    <option value="all" selected>Status</option>
                    <option onselect="myfuction()" value="active">Active</option>
                    <option onselect="myfuction()" value="inactive">Inactive</option>

                </select>

            </div>

            <table id="myTable">
                <tr>
                    <th>#ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php while ($rows = $result1->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $rows['productId']; ?></td>
                        <td><?php echo $rows['productName']; ?></td>
                        <td><?php echo $rows['category']; ?></td>
                        <td><img style="height: 50px;" src="<?php echo $rows['productImg']; ?>" alt=""></td>
                        <td><?php echo $rows['qty']; ?></td>
                        <td><?php echo $rows['actualPrice']; ?></td>
                        <td><?php if ($rows['status'] == 1) {
                                echo "Active";
                            } else {
                                echo "Inactive";
                            } ?></td>
                        <td>
                            <button name="udate" class="update button">
                                <a href="update.php?id=<?php echo $rows['productId']; ?>">Update</a>
                            </button>
                            <button name="status" class="status button">
                                <?php
                                $id = $rows['productId'];
                                if ($rows['status'] == 1) { ?>

                                    <a href="?type=status&operation=deactive&id=<?php echo $rows['productId']; ?>">Active</a>
                                <?php
                                } else { ?>
                                    <a href="?type=status&operation=active&id=<?php echo $rows['productId']; ?>">Deactive</a>
                                <?php }

                                ?>
                            </button>

                            <button name="delete" class="delete button">
                                <a href="delete.php?id=<?php echo $rows['productId']; ?>">Delete</a>
                            </button>

                        </td>
                    </tr>
                <?php } ?>

            </table>


        </div>
    </div>

    <script>
        function myfunction(value) {
            var input, filter, table, tr, td, i, txtValue, type;

            if (value == 1) {
                type = "search";
                input = document.getElementById("productName");
            } else if (value == 2) {
                type = "btn";
                input = document.getElementById("category");
            } else if (value == 6) {
                type = "btn";
                input = document.getElementById("status");
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
                    } else if (filter == "CATEGORY") {
                        console.log("here");
                        tr[i].style.display = "";
                    } else if (filter == "ALL") {

                        tr[i].style.display = "";
                    } else {

                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>