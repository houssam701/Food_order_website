<?php 
session_start();
require('db_connect.php');
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_address = $_SESSION['user_address'];
$user_phone = $_SESSION['user_phone'];
//get user info from database
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $food_name = $_POST['name'];
    $food_price = $_POST['price'];
    $food_quantity = $_POST['quantity'];
    $date_time= $_POST['localDateTime'];
    $sql = "INSERT INTO order_tbl (user_name,user_phone,user_address,food_name,food_price,food_quantity,date_time) VALUES ('$user_name','$user_phone',
    '$user_address','$food_name','$food_price','$food_quantity',NOW())";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "data inserted";
    }else{
        die(mysqli_error($conn));
    }
}

?>