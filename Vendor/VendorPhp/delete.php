<?php

include '../../connection.php'; // Using database connection file here

$id = $_GET['id']; // get id through query string

$sql= "DELETE FROM product where productId='$id'";
$result = $connect->query($sql);
   

if($result)
{
    $connect->close(); // Close connection
    header("location:productlist.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>
