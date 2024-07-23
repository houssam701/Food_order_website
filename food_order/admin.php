<?php
session_start();
require('db_connect.php');
if (!isset($_SESSION['admin_id'])) {
  // Redirect to the login page or display an error message
  header("Location: login.php");
  exit;
}
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name=$_POST['name'];  
    $price=$_POST['price']; 
    $description=$_POST['description']; 
    $file=$_FILES['image'];
    $file_name=$file['name'];   
    $tempname =$file['tmp_name'];
    $folder = 'images/'.$file_name; 
    $sql="insert into product (name,image,price,description) values('$name','$folder','$price','$description')";
    $result=mysqli_query($conn,$sql);
    if($result){
      move_uploaded_file($tempname, $folder);
      echo"Data inserted successfully!";
    }else
    {
        die(mysqli_error($conn));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <link rel="stylesheet" href="admin.css">
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
  <section class="cont"> <div class="form-container">
    <div class="form-title">Add Food</div>
    <form action="" method="post" enctype="multipart/form-data">  
      <input type="text" class="form-input" placeholder="Enter food name" name="name" required/>
      <input type="text" class="form-input" placeholder="Enter food price " name="price" required/>
      <input type="text" class="form-input" placeholder="Description" name="description" required/>
      <input type="file" class="form-input" placeholder="image" name="image" required/>
      <button type="submit" class="form-submit">Submit</button>
    </form>
  </div>
</section>
 


 <!--ends form  -->
 <section id="tbl">
  <table>
    <thead>
      <tr>
        <th>Food name</th>
        <th>Image</th>
        <th>Price</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql="select * from product";
        $result=$conn->query($sql);
        if($result){
          while($row=mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $name =$row['name'];
            $imagename = $row['image'];
            $price= $row['price'];
            $description=$row['description'];
            echo '
            <tr>
            <td>'.$name.'</td>
            <td><img src='.$imagename.' style="height: 50px;"/></td>
            <td>'.$price.'</td>
            <td>'.$description.'</td>
            <td>
            <button class="btn" style=" border:none; background-color: #0eb5f2; padding:10px;"><a href="update.php?updateid='.$id.'" style="color: white; text-decoration:none;font-size:large;">Update</a></button>
            <button class="btn" style="border :none; background-color: red; padding:10px;"><a href="delete.php?deleteid='.$id.'" style="color: white; text-decoration:none;font-size:large;">Delete</a></button>
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
