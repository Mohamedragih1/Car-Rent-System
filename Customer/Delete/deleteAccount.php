<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database_name = "Car_Rental_System";
    
    
    $conn = mysqli_connect($servername, $username, $password, $database_name);
    
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }


    session_start(); // Start the session

    // Check if the user is logged in (check for session data)
    if (isset($_SESSION['ssn']))
        $ssn = $_SESSION['ssn'];

        $sql = "DELETE FROM `users` WHERE ssn = '$ssn'";
        $result = mysqli_query($conn, $sql);
        
        echo '<script>alert("Accounted has been deleted!")</script>';
        echo("<script>window.location = '../../Sign-In/Customer-Sign-In/index.html';</script>");

        mysqli_close($conn);
?>
