<?php
session_start();
// Include the database connection file
require('db_connect.php');
if (!isset($_SESSION['email'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id']; 

    $sqll = "SELECT date_time FROM order_tbl WHERE order_id=$order_id";
    $resultt = $conn->query($sqll);
    if ($resultt->num_rows > 0) {
        // Fetch the first row (assuming you have only one row)
        $row = $resultt->fetch_assoc();
        
        // Get the database dateandtime
        $dbDateTime = $row['date_time'];

         // Get current local date and time
        $timezone = new DateTimeZone('Asia/Beirut');

        $currentDateTime = new DateTime('', $timezone);
        $currentDate = $currentDateTime->format('Y-m-d');
        $currentTime = $currentDateTime->format('H:i:s');
        // Split the database dateandtime into date and time
        list($dbDate, $dbTime) = explode(" ", $dbDateTime);

        // Compare dates
    if ($currentDate == $dbDate) {
        // Dates are equal, compare times
        $currentDateTime = new DateTime($currentTime);
        $dbDateTime = new DateTime($dbTime);

        $interval = $currentDateTime->diff($dbDateTime);
        $minutesDifference = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;

        if ($minutesDifference > 10) {
            // Do something if the difference in time is more than 10 minutes
            echo "<script>alert('You cannot do it because the time difference is more than 10 minutes.');</script>";
        } else {
            $sql = "DELETE FROM order_tbl WHERE order_id=$order_id";
            $result = mysqli_query($conn,$sql);
            if($result){
            header('Location: userOrder.php');
            } else{
            die(mysqli_error($conn));
            }
        }
    } else {
        // Dates are not equal
        echo "<script>alert('You cannot do it because of the difference of time!!!');</script>";
    }
}




}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Order</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="userOrder.css">
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
    <section id="tbl">
  <table>
    <thead>
      <tr>
        <th>Food name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Date&Time</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $user_id = $_SESSION['user_id'];
        $sql="SELECT * from order_tbl WHERE user_id =$user_id";
        $result=$conn->query($sql);
        if($result){
          while($row=mysqli_fetch_assoc($result)){
            $order_id = $row['order_id'];
            $food_name =$row['food_name'];
            
            $food_price= $row['food_price'];
            $food_quantity=$row['food_quantity'];
            $date_time= $row['date_time'];
            echo '
            <tr>
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
</body>
</html>