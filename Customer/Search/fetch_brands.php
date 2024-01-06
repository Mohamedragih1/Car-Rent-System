<?php
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "Car_Rental_System";


$conn = mysqli_connect($servername, $username, $password, $database_name);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Fetch distinct car brands based on the selected city
$sql = "SELECT DISTINCT brand FROM car";
$result = $conn->query($sql);

$options = '<option value="ANY">ANY</option>'; 
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['brand'] . '">' . $row['brand'] . '</option>';
    }
} else {
    $options .= '<option value="">No brands available</option>';
}

echo $options;


$conn->close();
?>
