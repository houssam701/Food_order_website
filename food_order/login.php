<?php
// Start a PHP session to manage user login state, allowing you to store and manage user data between different web pages.
session_start();

// Include the database connection file. This line includes the external file db_connect.php, which presumably contains the database connection details and sets up the $conn object to connect to the database.
require('db_connect.php');
// Check if the login form has been submitted
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Prevent SQL injection by escaping user inputs (use prepared statements for production)
    $email = $conn->real_escape_string($email);
    

    // Query the user table for the provided username
    $query = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($query);
    

    if ($result->num_rows > 0) {
        // If a user with the provided username is found in the database, We then use the fetch_assoc() method to fetch the data from the first row of the result set as an associative array. This means that we can access the column values by their names. In this case, we retrieve the hashed password value and store it in the variable $hashedPassword.
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
        

        // Use password_verify to check if the input password matches the hashed password
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['fullName'];
            $_SESSION['user_address'] = $row['address'];
            $_SESSION['user_phone'] =$row['phone'];
            
            header("Location: index.php"); // Redirect to the main page after successful login
        } else {
            // If passwords do not match, display an error message
            
        echo "<script>alert('Incorrect Password');</script>";
        }
    }else  if ($email === "admin@123" && $password === "admin123") {
      // Set a session variable to indicate that the user is logged in
      $_SESSION['admin_id'] = 123; // You can set any value here as an identifier for the admin user

      // Redirect to the admin page
      header("Location: admin.php");
      exit();
    }else {
        // If the provided username does not exist, display an error message
        echo   "<script>alert('Invalid email');</script>";
    }
}

// If the user is not already authenticated, display the login form, with fields for the username and password.
// if (!isset($_SESSION['user'])) {
// header("Location: signup.html");
// }
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Bootstrap 5 Login Form (with Glassmorphism)</title>
  <link rel="stylesheet" href="./loginStyle.css">

</head>
<body>
<!-- partial:index.partial.html -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<div class="bg">


</div>

  <main class="form-signin">
    
      <h1 class="h3">Login to eat</h1>
    
    <form action="" method="post">


      <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"  name="email" required>
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
        <label for="floatingPassword">Password</label>
      </div>

      <div class="checkbox mb-3">
        <div class="form-check form-switch">
      </div>
      </div>
      <button class="w-100 btn btn-lg" type="submit">Sign in</button>
    </form>
          <p class="copyright">&copy; WOWFood / <a href="signup.php">sign up</a></p>
  </main>
<!-- partial -->
  
</body>
</html>
