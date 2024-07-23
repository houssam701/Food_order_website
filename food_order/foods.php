<?php 
session_start();

require('db_connect.php');
if (!isset($_SESSION['email'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_address = $_SESSION['user_address'];
$user_phone = $_SESSION['user_phone'];
//get user info from database
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $food_name = $_POST['name'];
    $food_price = $_POST['price'];
    $food_quantity = $_POST['quantity'];
    $sql = "INSERT INTO order_tbl (user_name,user_phone,user_address,food_name,food_price,food_quantity,date_time,user_id) VALUES ('$user_name','$user_phone',
    '$user_address','$food_name','$food_price','$food_quantity',NOW(),'$user_id')";
    $result=mysqli_query($conn,$sql);
    if($result){
    
    }else{
        die(mysqli_error($conn));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WOWfood Menu</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    
                    <li>
                        <a href="foods.php">Menu</a>
                    </li>
                    <li>
                    <a href="userOrder.php">Order</a>
                    </li>
                    <li>
                    <a href="logout.php">LogOut</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <!-- <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section> -->
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            $sql ="select * from product";
            $result=$conn->query($sql);
            if($result){
                while($row=mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $name =$row['name'];
                    $imagename = $row['image'];
                    $price= $row['price'];
                    $description=$row['description'];
                    echo '
                    <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src='.$imagename.' alt="Chicke Hawain Momo" class="img-responsive img-curve">
                    </div>
    
                    <form class="food-menu-desc" action=""  method="post" enctype="multipart/form-data" onsubmit="submitForm(event)">
                        <h4>'.$name.'</h4>
                        <p class="food-price">'.$price.'</p>
                        <p class="food-detail">
                            '.$description.'
                        </p>
                        <br>  
                        <input type="number" name="quantity" min="1" style="width: 200px; height: 20px; padding: 2px;" minlength="1" placeholder="Quantity">
                        <input type="hidden" value="'.$price.'" name="price">
                        <input type="hidden" value="'.$name.'" name="name">
                        
                        <input class="btn btn-primary" type="submit" value="Send to Kitchen">
                    </form>
                    </div>
                    ';

                }
            }
            
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">Vijay Thapa</a></p>
        </div>
    </section>
    <!-- footer Section Ends Here -->
<script>
    function submitForm() {
    
    // Get current local date and time
    var currentDate = new Date();
    var localDateTime = currentDate.toLocaleString(); // Local date and time format
    console.log(localDateTime);
    // Update hidden input field with local date and time
    document.getElementById("localDateTime").value = localDateTime;
    
    }   
</script>
</body>
</html>