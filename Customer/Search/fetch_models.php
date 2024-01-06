<?php
// Establish a connection to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Car_Rental_System";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the selected city and brand from the AJAX request
$selectedBrand = $_POST['brand'];

// Fetch distinct car models based on the selected city and brand
$sql = "SELECT DISTINCT model FROM car WHERE brand = '$selectedBrand'";
$result = $conn->query($sql);

// Populate the dropdown with fetched car models
$options = '<option value="ANY">ANY</option>'; // Adding an "ANY" option
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['model'] . '">' . $row['model'] . '</option>';
    }
} else {
    $options .= '<option value="">No models available</option>';
}

echo $options;

$conn->close();
?>
