<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the database connection
require_once('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Securely hash the password


    // Insert user data into the 'user' table
    $sql = "INSERT INTO user (fullName,password,email,address,phone) VALUES ('$fname', '$password', '$email', '$address', '$phone')";
    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Bootstrap 5 Login Form (with Glassmorphism)</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<div class="bg">


</div>

  <main class="form-signin">
    
      <h1 class="h3">SignUp for your meal</h1>
    
    <form action="" method="POST">

      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="fname"required>
        <label for="floatingInput">Full Name</label>
      </div>
      <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
        <label for="floatingInput">Email address</label>
      </div>
   
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" placeholder="your full address" name="address" required>
        <label for="floatingInput">Your full address</label>
      </div>
      <div class="form-floating">
        <input type="tel" class="form-control" id="floatingInput" placeholder="Your Phone number" name="phone" required>
        <label for="floatingInput">Phone</label>
      </div>
         <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
        <label for="floatingPassword">Password</label>
      </div>
      <button class="w-100 btn btn-lg" type="submit">Sign up</button>
    </form>
          <p class="copyright">&copy;  WOWFood</p>
  </main>
<!-- partial -->
  
</body>
</html>
