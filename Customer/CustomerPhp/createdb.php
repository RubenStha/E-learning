<?php
class CreateDb
{
    public $con;

    function __construct()
    {
        $this->con = mysqli_connect("localhost", "root", "");
        if (!$this->con) {
            echo "error in connecting database" . mysqli_connect_error();
        }
        $sql = "CREATE DATABASE IF NOT EXISTS ecommerce";

        if (!mysqli_query($this->con, $sql)) {
            die("error in connecting database" . mysqli_connect_error());
        }
        $this->con = mysqli_connect("localhost", "root", "", "ecommerce");


        $sql1 = "CREATE TABLE IF NOT EXISTS user(
            username varchar(20) not null primary key,
            password varchar(30),
            usertype varchar(10));";

        $sql2 = "CREATE TABLE IF NOT EXISTS product(
            productId INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            productName VARCHAR(25) NOT NULL,
            category    varchar(25) NOT NULL,
            brand varchar(25),
            actualPrice int,
            productImg varchar(100),
            shortDes varchar(100),
            longDes varchar(150),
            mrk int,
            qty int,
            status tinyint,
            vendor varchar(50)
        );";

        $sql3 = "CREATE TABLE IF NOT EXISTS vendor(
                vendor_id int not null auto_increment primary key,
                username varchar(20),
                name varchar(30),
                contact varchar(10),
                email varchar(30)
                );";
        $sql4 = "CREATE TABLE IF NOT EXISTS customer(
                customer_id int not null auto_increment primary key,
                username varchar(20),
                name varchar(30),
                contact numeric(10),
                email varchar(30)
                );";

        $sql5 = "CREATE TABLE IF NOT EXISTS cart(
                user_name varchar(20),
                productId varchar(20),
                cart_qty varchar(30),
                color varchar(10),
                size varchar(10),
                level int
                );";

        $sql6 = "CREATE TABLE IF NOT EXISTS categories(
                category_id int not null auto_increment primary key,
                category_name varchar(20),
                status int
                );";

        $sql7 = "CREATE TABLE IF NOT EXISTS getOrder(
                orderId int not null auto_increment primary key,
                customerName varchar(20),
                productId varchar(20),
                orderQty int,
                color varchar(10),
                size varchar(10),
                level int,
                address varchar(255)
                );";


        $sqls = array($sql1, $sql2, $sql3, $sql4, $sql5, $sql6, $sql7);
        foreach ($sqls as $sql) {
            if (!mysqli_query($this->con, $sql)) {
                echo "Creating table fail " . mysqli_error($this->con);
            }
        }
    }
    public function getData($tablename)
    {
        $sql = "SELECT * FROM `$tablename`";
        $execute = mysqli_query($this->con, $sql);

        if (mysqli_num_rows($execute) > 0) {
            return $execute;
        }
    }
    public function getJoinData($user)
    {
        $sql = "SELECT * FROM cart  INNER JOIN product ON cart.productId=product.productId AND cart.user_name='$user'";
        $execute = mysqli_query($this->con, $sql);

        if (mysqli_num_rows($execute) > 0) {
            return $execute;
        } else {
            return $execute;
        }
    }
}
