<?php
    include '../../connection.php'; 
        
    $id = $_GET['id'];
    $sql1= "SELECT * FROM `product` WHERE `productId`= $id";
    $result = $connect->query($sql1);

    $sql2="SELECT * FROM `categories`";
    $result2 = $connect->query($sql2);
        
    if (isset($_POST['submit'])) 
    {
            $prdcategory=$_POST['category'];
            $name = $_POST["name"]; 
            $mrkprice = $_POST['mrkprice'];
            $price = $_POST["price"];
            $status = $_POST["status"];
            $brand = $_POST["brand"];
            $qty=$_POST['qty'];
            $sdescription = $_POST["short_description"];
            $ldescription= $_POST["long_description"];
            
            $files = $_FILES['file'];
            if($files['name']!=null)
            {
            $filename = $files['name'];
            $file_error = $files['error'];
            $filetmp = $files['tmp_name'];

            $file_ext = explode('.',$filename);
            $filecheck = strtolower(end($file_ext));

            $fileStoreType = array('png','jpg','jpeg');
            if(in_array($filecheck,$fileStoreType))
            {
                $destinationFile = 'productImg/'.$filename;
                move_uploaded_file($filetmp,$destinationFile);
            }
    $sql="UPDATE `product` SET `productName`='$name',`category`='$prdcategory',`shortDes`='$sdescription',`longDes`='$ldescription',`mrk`='$mrkprice',`productImg`='$destinationFile',`actualPrice`='$price',`qty`='$qty',`brand`='$brand', `status`='$status' WHERE `productId`='$id'";
               
}    

else{
    $sql="UPDATE `product` SET `productName`='$name',`category`='$prdcategory',`shortDes`='$sdescription',`longDes`='$ldescription',`mrk`='$mrkprice',`actualPrice`='$price',`qty`='$qty' WHERE `productId`='$id'";            
}
    
            
           
               
            if ($connect->query($sql)) {
                echo "Product updated successfully";
                header ("location:productlist.php");
              } else {
                echo "Error: " . $sql . "<br>" . $connect->error;
              }
    }        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addproduct.css">
    <title>product update</title>
</head>
<body>
    <div class="body">
        <div class="nav">
        </div>

        <div class="hero">
            <?php
            while($rows=$result->fetch_assoc())
            {?>
            <form action="" method="POST" enctype="multipart/form-data">
            <div class="header">
                    <h1>Edit Product</h1>
                
                    <div class="edit">
                        <button class="btn inactive">Discard</button>
                        <button class="btn active" name="submit">Update Now</button>
                    </div>
            </div>
            <div class="input">
                <div class="general-info">
                        <div class="mb-4">
                            <label for="product_title" class="form-label">Product title</label>
                            <input type="text" name="name" value="<?php echo $rows['productName'];?>" class="form-control" id="product_title">
                        </div>
                        <div class="row">
                            <div >
                                <label for="market_price" class="form-label">Market Price</label>
                                <input type="numeric" name="mrkprice" value="<?php echo $rows['mrk'];?>" class="form-control" id="market_price">
                            </div>
                            <div >
                                <label for="price" class="form-label">Price</label>
                                <input type="numeric" name="price" value="<?php echo $rows['actualPrice'];?>" class="form-control" id="price">
                            </div>
                            <div>
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="numeric" name="qty" value="<?php echo $rows['qty'];?>" class="form-control" id="qty">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="product_brand" class="form-label">Brand</label>
                            <input type="text" value="<?php echo $rows['brand'];?>" name="brand" class="form-control" id="product_brand">
                        </div>
                </div>
                <div class="description">
                        <div>
                            <label class="form-label">Description</label>
                            <textarea name="long_description" class="form-control" rows="4" >
                            <?php echo $rows['longDes'];?>
                            </textarea>
                        </div>
                </div>
                <div class="price">
                        <div class="card-body">
                            <div class="mb-4">
                                <label class="form-label">Short Description</label>
            
                                <textarea name="short_description" id="" cols="30" class="form-control" rows="8">
                                    <?php echo $rows['shortDes'];?>
                                </textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Status</label>
                                
                                <select class="form-select" name="status">
                                    <option><?php if($rows['status']==1){echo "Published";}else{echo "Draft";} ?></option>
                                    <option value="1">Published</option>
                                    <option value="0">Draft</option>
                                </select>
                </div>

                        <hr>
                        <br>
                        <h5>Categories</h5>
                        <div class="form-check">
                               <select class="form-select"name="category">
                                <option><?php echo $rows['category']; ?></option>
                                <?php while($rows1=$result2->fetch_assoc()) 
                                { ?>
                                        <option value="<?php echo $rows1['category']; ?>"><?php echo $rows['category']; ?></option>
                                    <?php 
                                } ?>
                                

                                
                            </select>
                                                              
                           <img id="output" style="height: 150px; border:5px solid grey;margin: 10px 50px;" src="<?php echo $rows['productImg']; ?>"/>
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
            <?php }?>

          
    
          
    
    </div>
     <script src="../js/nav.js"></script>
     <script>
            var loadFile = function(event) {

                
                var obj = document.getElementById("output");
                // Object.assign(obj.style, styles);


                // var style = document.getElementById('output').style.height = '180px';
                var output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
                }
            };
            </script>
   
    
    
</body>
</html>