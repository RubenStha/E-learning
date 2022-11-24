<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
include '../../connection.php';
    if (isset($_POST['submit'])) 
    {
        $category = $_POST['category_name'];
        $status = $_POST['status'];

            $sql= "INSERT INTO `categories`(`category_name`,`status`) VALUES ('$category','$status')";
            if ($connect->query($sql) === TRUE) {
                echo "Successfully added new category";
              } else {
                echo "Error: " . $sql . "<br>" . $connect->error;
              }
    } 
    if(isset($_POST['edit']))
    {
        $category = $_POST['category_name'];
        $status = $_POST['status'];
        $id = $_POST['catId'];

            $sql= "UPDATE `categories` SET `category_name`='$category',`status`='$status' WHERE `category_id`='$id'";
            if ($connect->query($sql) === TRUE) {
                echo "Successfully added new category";
              } else {
                echo "Error: " . $sql . "<br>" . $connect->error;
              }

    } 
    if(isset($_POST['delete']))
    {
        $id = $_POST['catId'];

            $sql= "DELETE FROM `categories` WHERE `category_id`='$id'";
            if ($connect->query($sql) === TRUE) {
                echo "Deleted Data";
              } else {
                echo "Error: " . $sql . "<br>" . $connect->error;
              }

    }


    $sql2= "SELECT * FROM `categories` ORDER by `status` DESC;";
        $result1 = $connect->query($sql2);
        $connect->close();

?>

<body>
    <h3>Available Categories for the products: </h3>
    <table>
        <tr> <th>category</th> <th>Status</th> <th>action</th></tr>
        <form action="" method="post">
    
<?php
       // LOOP TILL END OF DATA 
    while($rows=$result1->fetch_assoc())
    {
    ?>  
               <tr> 
                   <td> <input type="text" value="<?php echo $rows['category_name']; ?>" name="category_name"></td>
                   
                   <td> <select name="status" id="" value="">
                            <option selected><?php if($rows['status'] == 1 ) {echo "Active";}else{echo "Inactive";}?></option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <input type="number" hidden value="<?php echo $rows['category_id']; ?>" name="catId">
                        <button name="edit">Update</button>
                        <button name="delete">Delete</button>
                        </td>
                 </tr>

                 
               
            <?php 
            }
            ?>
            </form>
</table>
    <form action="" method="POST">
            <br><input type="text" name="category_name" id="" placeholder="Add Category"> 
             <select name="status" id="">
                 <option value="1">Active</option>
                 <option value="0">Inactive</option>
             </select>
            <input type="submit" value="Add catagory" name="submit">
        </div>
    </form>
</body>
</html>
