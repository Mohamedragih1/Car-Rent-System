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

// Fetch all distinct car years from the database
$sql = "SELECT DISTINCT year FROM car";
$result = $conn->query($sql);

// Populate the dropdown with fetched car years
$options = '<option value="ANY">ANY</option>'; // Adding an "ANY" option
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['year'] . '">' . $row['year'] . '</option>';
    }
}

echo $options;

$conn->close();
?>
