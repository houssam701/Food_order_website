<?php
require ('db_connect.php');
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];
    $sql = "delete from product where id=$id";
    $result = mysqli_query($conn,$sql);
    if($result){
        header('Location: admin.php');
    }else{
        die(mysqli_error($conn));
    }
}
?>