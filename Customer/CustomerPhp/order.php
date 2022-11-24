<?php

session_start();

include '../../connection.php';
require_once('createdb.php');
$database = new CreateDb();
$executeCart = $database->getJoinData();
$user = $_SESSION['user_name'];

$sql = "SELECT * FROM customer WHERE username ='$user'";
$result = $connect->query($sql);

$customer = $result->fetch_assoc();
echo $customer['name'];

if (isset($_SESSION['user_name'])) {


    while ($product =  $executeCart->fetch_assoc()) {
        if ($user == $product['user_name']) {
            echo $product['productId'];
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
    <title>Cart Check out</title>
</head>

<body>
    <form action="" method="post">
        <p>Delivery Address</p>
        <p><?php echo $customer['contact']; ?> <span class="edit-btn">Edit</span></p>
        <p><?php echo $customer['email']; ?> <span class="edit-btn">Edit</span></p>
        <h3>Order Summary</h3>
        <p> Subtotal item <span id="item"></span></p>

    </form>
</body>

</html>