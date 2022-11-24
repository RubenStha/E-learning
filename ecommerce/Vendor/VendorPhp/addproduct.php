<?php
session_start();
if (isset($_SESSION['user_name'])) {
    $vendor = $_SESSION['user_name'];
}

include '../../connection.php';
$sql = "SELECT * FROM `categories`";
$result2 = $connect->query($sql);

if (isset($_POST['submit'])) {

    $prdcategory = $_POST['category'];
    $name = $_POST["name"];
    $mrkprice = $_POST['mrkprice'];
    $price = $_POST["price"];
    $qty = $_POST['qty'];
    $brand = $_POST['brand'];
    $status = $_POST['status'];
    $sdescription = $_POST["short_description"];
    $ldescription = $_POST["long_description"];

    $files = $_FILES['file'];

    $filename = $files['name'];
    $file_error = $files['error'];
    $filetmp = $files['tmp_name'];

    $file_ext = explode('.', $filename);
    $filecheck = strtolower(end($file_ext));

    $fileStoreType = array('png', 'jpg', 'jpeg');
    if (in_array($filecheck, $fileStoreType)) {
        $destinationFile = '../../productImg/' . $filename;
        move_uploaded_file($filetmp, $destinationFile);
        $sql = "INSERT INTO `product`(`productName`,`category`, `shortDes`, `longDes`,`productImg`,`mrk`,`actualPrice`,`qty`,`brand`,`status`,`vendor`) VALUES ('$name','$prdcategory','$sdescription','$ldescription','$destinationFile','$mrkprice','$price','$qty','$brand','$status','$vendor')";
        if ($connect->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../VendorCss/VendorAddproduct.css">
    <title>Add product</title>
</head>

<body>
    <div class="body">
        <div class="nav">
        </div>

        <div class="hero">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="header">
                    <h1>Add product</h1>

                    <div class="edit">
                        <button class="btn inactive">Clear All</button>
                        <button class="btn active" name="submit">Publish now</button>
                    </div>
                </div>
                <div class="input">
                    <div class="general-info">
                        <div class="mb-4">
                            <label for="product_title" class="form-label">Product title</label>
                            <input type="text" name="name" placeholder="Product Name" class="form-control" id="product_title">
                        </div>
                        <div class="row">
                            <div>
                                <label for="market_price" class="form-label">Market Price</label>
                                <input type="numeric" name="mrkprice" placeholder="Market Price" class="form-control" id="market_price">
                            </div>
                            <div>
                                <label for="price" class="form-label">Price</label>
                                <input type="numeric" name="price" placeholder="Price of Product" class="form-control" id="price">
                            </div>
                            <div>
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="numeric" name="qty" placeholder="Type here" class="form-control" id="qty">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="product_brand" class="form-label">Brand</label>
                            <input type="text" placeholder="Brand Name" name="brand" class="form-control" id="product_brand">
                        </div>
                    </div>
                    <div class="description">
                        <div>
                            <label class="form-label">Description</label>
                            <textarea name="long_description" placeholder="Type here" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="price">
                        <div class="card-body">
                            <div class="mb-4">
                                <label class="form-label">Short Description</label>

                                <textarea name="short_description" id="" cols="30" class="form-control" rows="8"></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="1">Published</option>
                                    <option value="0">Draft</option>
                                </select>
                            </div>

                            <hr>
                            <br>
                            <h5>Categories</h5>
                            <div class="form-check">
                                <select class="form-select" name="category">
                                    <?php while ($rows = $result2->fetch_assoc()) { ?>
                                        <option value="<?php echo $rows['category_name']; ?>"><?php echo $rows['category_name']; ?></option>
                                    <?php
                                    } ?>



                                </select>

                                <img id="output" /><br>
                            </div>
                        </div>

                    </div>
                    <div class="upimg">
                        <div>
                            <label class="form-label">Images</label>
                            <input type="file" class="form-control" name="file" accept="image/*" onchange="loadFile(event)">
                        </div>
                    </div>
                </div>
            </form>






        </div>





    </div>
    <script>
        var loadFile = function(event) {

            var styles = {
                "margin": "10px 50px",
                "border": "5px solid #d4d1d1",
                "height": "180px"
            };

            var obj = document.getElementById("output");
            Object.assign(obj.style, styles);


            // var style = document.getElementById('output').style.height = '180px';
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
    <script src="../VendorJs/nav.js"></script>


</body>

</html>