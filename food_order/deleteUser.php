<?php
require ('db_connect.php');
if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];

    $sqll = "SELECT date_time FROM order_tbl WHERE order_id=$order_id";
    $resultt = $conn->query($sqll);
    if ($resultt->num_rows > 0) {
        // Fetch the first row (assuming you have only one row)
        $row = $resultt->fetch_assoc();
        
        // Get the database dateandtime
        $dbDateTime = $row['date_time'];

         // Get current local date and time
        $currentDateTime = new DateTime();
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
        $minutesDifference = $interval->i;

        if ($minutesDifference > 10) {
            // Do something if the difference in time is more than 10 minutes
            echo "<script>alert('You cannot do it because the time difference is more than 10 minutes.');</script>";
        } else {
            $sql = "delete from product where id=$id";
            $result = mysqli_query($conn,$sql);
            if($result){
            header('Location: userOrder.php');
            } else{
            die(mysqli_error($conn));
            }
        }
    } else {
        // Dates are not equal
        echo "<script>alert('You cannot do it because the time difference is more than 10 minutes.');</script>";
    }
}
}
?>
