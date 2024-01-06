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

// Fetch all distinct car colors from the database
$sql = "SELECT DISTINCT color FROM car";
$result = $conn->query($sql);

// Populate the dropdown with fetched car colors
$options = '<option value="ANY">ANY</option>'; // Adding an "ANY" option
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['color'] . '">' . $row['color'] . '</option>';
    }
}

echo $options;

$conn->close();
?>
