
<?php 
session_start();
require('db_connect.php');
if (!isset($_SESSION['admin_id'])) {
  // Redirect to the login page or display an error message
  header("Location: login.php");
  exit;
}

$id = $_GET['updateid'];
$ssql="SELECT * FROM product WHERE id=$id";
$res=mysqli_query($conn,$ssql);
$row = mysqli_fetch_assoc($res);

$name2=$row['name'];
$imageName2=$row['image'];
$price2=$row['price'];
$description2 =$row['description'];

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $name=$_POST['name'];  
    $price=$_POST['price']; 
    $description=$_POST['description']; 
    $file=$_FILES['image'];
    $file_name=$file['name'];   
    $tempname =$file['tmp_name'];
    $folder = 'images/'.$file_name; 

    $sql="UPDATE product 
    SET id='$id',name='$name',image='$folder',price='$price',
    description='$description'
    WHERE id=$id";
    $result=mysqli_query($conn,$sql);

    if($result){
    move_uploaded_file($tempname, $folder);
    header('Location: admin.php');
    }else
    {
        die(mysqli_error($conn));
    }
}




?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <style>

.cont {
  background-color: #f0f0f0; /* Rare gray color */
  display: flex;
  justify-content: center;
  align-items: center;
  height: 65vh;
  margin: 0;
}

.form-container {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  width: 400px; /* Adjust the width as needed */
}

.form-title {
  font-size: 1.5em;
  text-align: center;
  margin-bottom: 20px;
}

.form-input {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  font-size: 1.2em; /* Large font size */
  box-sizing: border-box;
}

.form-submit {
  width: 100%;
  padding: 10px;
  background-color: #0eb5f2;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1.2em; /* Large font size */
  }

    </style>
</head>
<body>
<div class="form-title">Update Food</div>
    <form action="" method="post" enctype="multipart/form-data">  
      <input type="text" class="form-input"  placeholder="Enter food name" name="name" required value="<?php echo $name2; ?>"/>
      <input type="text" class="form-input" placeholder="Enter food price " name="price" required value="<?php echo $price2; ?>"/>
      <input type="text" class="form-input" placeholder="Description" name="description"required value="<?php echo $description2; ?>"/>
      <input type="file" class="form-input" placeholder="image" name="image" required/>
      <button type="submit" class="form-submit">Submit</button>
    </form>
    <button class="from-submit"><a href="admin.php">Go Back</a></button>

  </div>
</body>
</html>