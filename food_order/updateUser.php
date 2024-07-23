<?php 
require('db_connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$user_id = $_POST['user_id']; 
$sql = "DELETE FROM user WHERE id=$user_id";
$result = mysqli_query($conn,$sql);
if($result){
header('Location: updateUser.php');
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
        <th>User ID</th>
        <th>User Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
        $sql="SELECT * from user";
        $result=$conn->query($sql);
        if($result){
        while($row=mysqli_fetch_assoc($result)){
            $user_id = $row['id'];
            $user_name = $row['fullName'];
            $user_email = $row['email'];
            $user_address = $row['address'];
            $user_phone = $row['phone'];

            echo '
            <tr>
            <td>'.$user_id.'</td>
            <td>'.$user_name.'</td>
            <td>'.$user_phone.'</td>          
            <td>'.$user_address.'</td>
            <td>'.$user_email.'</td>
            <td>
            <button class="btn" style=" border:none; background-color: #0eb5f2; padding:10px;"><a href="edit_user.php?user_id='.$user_id.'" style="color: white; text-decoration:none;font-size:large;">Update</a></button>
            <form action="" method="post">
            <input type="hidden" name="user_id" value="'.$user_id.'">
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