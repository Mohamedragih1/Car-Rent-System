<?php
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "Car_Rental_System";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database_name);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
session_start();
if (isset($_SESSION['ssn'])) 
  $ssn = $_SESSION['ssn'];


if (isset($_SESSION['plate_id'])) 
  $plateId = $_SESSION['plate_id'];
  
if (isset($_SESSION['pickupDate'])) 
  $pickUp = $_SESSION['pickupDate'];


if (isset($_SESSION['returnDate'])) 
  $return = $_SESSION['returnDate'];
if (isset($_SESSION['total_price'])) 
  $totalPrice = $_SESSION['total_price'];

$query = " INSERT INTO reservation (`pickup_date`,`return_date`,`ssn`,`plate_id`,`price`) VALUES ('$pickUp','$return','$ssn','$plateId','$totalPrice') ; ";
$result = mysqli_query($conn, $query);
if ($result) {
  echo '<script>alert("Reservation successful!");</script>';
  echo("<script>window.location = '../Search/index.html';</script>");

  } else {
    echo '<script>alert("Error in reservation. Please try again.");</script>';
    echo("<script>window.location = 'makeReservation.php';</script>");
}
?>