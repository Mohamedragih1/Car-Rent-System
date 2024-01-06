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


session_start(); // Start the session



if (isset($_SESSION['ssn'])) 
  $ssn = $_SESSION['ssn'];


if (isset($_SESSION['plate_id'])) 
  $plateId = $_SESSION['plate_id'];
  
$pickUp=$_POST["pickupDate"];
$return=$_POST["returnDate"];


$pickUpObject = DateTime::createFromFormat('Y-m-d',$pickUp);
$returnObject = DateTime::createFromFormat('Y-m-d',$return);

if (isset($_SESSION['dates_array'])) {
  $datesArray = $_SESSION['dates_array'];

  // Loop through the array and check for date overlaps
  $isOverlap = false;
  foreach ($datesArray as $dateDetails) 
  {
      $existingPickUp = DateTime::createFromFormat('Y-m-d', $dateDetails['pickup_date']);
      $existingReturn = DateTime::createFromFormat('Y-m-d', $dateDetails['return_date']);

      // Check for overlap
      if (
          ($pickUpObject >= $existingPickUp && $pickUpObject <= $existingReturn) ||
          ($returnObject >= $existingPickUp && $returnObject <= $existingReturn) ||
          ($pickUpObject <= $existingPickUp && $returnObject >= $existingReturn)
      ) {
          $isOverlap = true;
          break; // No need to check further once overlap is detected
      }
  }
  if($isOverlap)
  {
    echo '<script>alert("Enter a valid date")</script>';
    echo("<script>window.location = 'makeReservation.php';</script>");
    die();
  }
}

//calculating the total days of reservation
$interval = $pickUpObject->diff($returnObject);
//query to fetch the price per day of the car
$query = "SELECT * FROM car WHERE plate_id = '$plateId'";
$result = mysqli_query($conn, $query);
$row =mysqli_fetch_assoc($result);

$pricePerDay=$row["pricePerDay"];
//calculating the total price of the reservation
$totalPrice=$pricePerDay * $interval->days;

$_SESSION['total_price']=$totalPrice;
$_SESSION['pickupDate']=$pickUp;
$_SESSION['returnDate']=$return;

//i want an alert message with the total price to appear here if the user confirms then continue
echo "<script>
    var isConfirmed = confirm('Total Price: $$totalPrice\\n\\nPress OK to continue with the reservation, or Cancel to go back.');
    if (isConfirmed) {
      window.location.href = 'proccessReservation.php';
    } else {
        // User canceled, you can handle this case as needed
        window.location.href = 'makeReservation.php';
    }
</script>";


?>