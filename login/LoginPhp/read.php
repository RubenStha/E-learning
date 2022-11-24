<?php
    include "../../connection.php";

    $sql_read = "SELECT * FROM `user`";

    $read = $connect->query($sql_read);

    $data_uname = array();

    if($read -> num_rows >0)
    {
        while($data = $read->fetch_assoc())
        {
            array_push($data_uname, $data['username']);
        }
    }    
?>