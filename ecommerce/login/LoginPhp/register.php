<?php 
include "../../connection.php";
 include "read.php";


	if (isset($_POST['submit'])) 
    {
		// get variables from the form
		$user_name = $_POST['username'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$pwd = $_POST['pwd'];
        $type =$_POST['type'];

        $U_match = 0;
    
		
        for($i = 0; $i<count($data_uname); $i++)
    {
        if($user_name == $data_uname[$i])
        {
            $U_match++;
        }
        // if( $contact == $data_contact[$i])
        // {
        //     $C_match++;
        // }
    }
    if($U_match==0)
    {
         
        $sql_user ="INSERT INTO `user`(`username`, `password`, `usertype`) VALUES ('$user_name','$pwd','$type')";

        if($type == "vendor")
        {
            $sql = "INSERT INTO `vendor`(`username`, `name`, `contact`,`email`) VALUES ('$user_name','$name','$contact','$email')";
        }
        else
        {
            $sql = "INSERT INTO `customer`( `username`, `name`, `contact`, `email`) VALUES ('$user_name','$name','$contact','$email')";
        }
        $result1 = $connect->query($sql);
        $result2= $connect->query($sql_user);
       
		// execute the query


		if ($result1 == TRUE && $result2 == true) {
			echo "New record created successfully.";
		}else{
			echo "Error:". $sql . "<br>". $connect->error;
		}

		$connect->close();

    }
    
    else{
        echo " Username already exist";
    }
		

	}
   



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vender Registration</title>
</head>
<body>
    <h2 class="vender-reg">
        Registration From
    </h2>
    <form action="" method="POST">
        <input type="text"  name="username" class="input uname" placeholder="Enter User" required>
        <input type="text" required name="name" class="input name" placeholder="Enter your full name">
        <input type="email" required name="email" class="input email" placeholder="Enter email address">
        <input type="number" required name="contact" class="input contact" placeholder="Enter contact">
        
        <label for="type">Vendor</label>
        <input type="radio" id="html" name="type" value="vendor" >
        
        <label for="type">Customer</label>
        <input type="radio" id="html" name="type" value="customer">
        

        <input type="password" required name="pwd" id="password" class="input pwd" placeholder="Create password" >
        <input type="password" required name="pwd1" class="input pwd1" id="confirm_password" placeholder="Retype password"onkeyup='check();'>
        <span id='message'></span>
        
        <input type="submit" name="submit" value="submit">
    </form>
    <script>
        var check = function() {
        if (document.getElementById('password').value ==
            document.getElementById('confirm_password').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'matching';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'not matching';
        }
}
    </script>
</body>
</html>