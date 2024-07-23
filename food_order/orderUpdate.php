<?php 
require('db_connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$order_id = $_POST['order_id']; 
$sql = "DELETE FROM order_tbl WHERE order_id=$order_id";
$result = mysqli_query($conn,$sql);
if($result){
header('Location: orderUpdate.php');
} else{
die(mysqli_error($conn));
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orders Page</title>
  <link rel="stylesheet" href="orderUpdate.css">
</head>
<body>

  <nav>
    <div class="logo"><img src="images/logo.png" alt="" style="height: 45px;"></div>
    
    <ul class="nav-list">
        <li class="nav-item" style="font-family: Brush Script MT, Brush Script Std, cursive	; color:#ff6b81;font-weight:bolder;font-size:larger ">Hello Admin</li>
        <li class="nav-item"><a href="admin.php" class="nav-link">Product</a></li>
        <li class="nav-item"><a href="orderUpdate.php" class="nav-link">Orders</a></li>
        <li class="nav-item"><a href="updateUser.php" class="nav-link">Users</a></li>
        <li class="nav-item"><a href="admin_logout.php" class="nav-link">Logout</a></li>
    </ul>
  </nav>

  <!-- endds navbar -->
  
    <!-- Navbar Section Ends Here -->
    <section id="tbl">
  <table>
    <thead>
      <tr>
        <th>Client Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Food name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Date&Time</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql="SELECT * from order_tbl";
        $result=$conn->query($sql);
        if($result){
          while($row=mysqli_fetch_assoc($result)){
            $order_id = $row['order_id'];
            $user_name = $row['user_name'];
            $user_phone = $row['user_phone'];
            $user_address = $row['user_address'];
            $food_name =$row['food_name'];
            $food_price= $row['food_price'];
            $food_quantity=$row['food_quantity'];
            $date_time= $row['date_time'];
            echo '
            <tr>
            <td>'.$user_name.'</td>
            <td>'.$user_phone.'</td>          
            <td>'.$user_address.'</td>
            <td>'.$food_name.'</td>
            <td>'.$food_price.'</td>
            <td>'.$food_quantity.'</td>
            <td>'.$date_time.'</td>
            <td>
            <form action="" method="post">
            <input type="hidden" name="order_id" value="'.$order_id.'">
            <button  type ="submit" class="btn" style="border :none; background-color: red; padding:10px;font-size:large; color:white; ">Delete</button>
            </form>
            </td>
          </tr> 
            ';
          }
        }
      ?>
    </tbody>
  </table>
</section>


</body>
</html>