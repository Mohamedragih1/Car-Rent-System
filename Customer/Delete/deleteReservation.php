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
    if (isset($_POST['reservationId']))
        $reservationId = $_POST['reservationId'];

        $sql = "DELETE FROM `reservation` WHERE reservation_id = '$reservationId'";
        $result = mysqli_query($conn, $sql);
        
        echo '<script>alert("Reservation has been deleted!")</script>';
        echo("<script>window.location = '../Search/index.html';</script>");

        mysqli_close($conn);
?>