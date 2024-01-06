<?php
session_start(); // Start the session

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

// Retrieve the submitted form data
$location = $_POST['Location'];
$brand = $_POST['Brand'];
$model = $_POST['Model'];
$year = $_POST['Year'];
$minPrice = $_POST['MinPricePerDay'];
$maxPrice = $_POST['MaxPricePerDay'];
$color = $_POST['Color'];
$minMiles = $_POST['MinMiles'];
$maxMiles = $_POST['MaxMiles'];

// Construct the SQL query based on the provided criteria
$sql = "SELECT c.brand,c.model,c.year,c.pricePerDay,c.color,c.miles,c.plate_id,os.startDate,os.endDate
        FROM car c 
        LEFT JOIN out_of_service os ON c.plate_id = os.plate_id
        JOIN office o ON c.office_id = o.office_id
        WHERE o.location = '$location'";

if ($brand !== 'ANY') {
    $sql .= " AND c.brand = '$brand'";
}
if ($model !== 'ANY') {
    $sql .= " AND c.model = '$model'";
}
if ($year !== 'ANY') {
    $sql .= " AND c.year = '$year'";
}
if ($color !== 'ANY') {
    $sql .= " AND c.color = '$color'";
}
if ($minMiles !== '' && $maxMiles !== '') {
    $sql .= " AND c.miles BETWEEN $minMiles AND $maxMiles";
}
if ($minPrice !== '' && $maxPrice !== '') {
    $sql .= " AND c.pricePerDay BETWEEN $minPrice AND $maxPrice";
}

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the car details and store them in a session variable
    $cars_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $_SESSION['cars_data'] = $cars_data;

    // Redirect to view_cars.php
    header("Location:../view/viewcars.php");
    exit();
} else {
    echo '<script>alert("No cars found with the specific criterea")</script>';
    echo("<script>window.location = 'index.html';</script>");
}

mysqli_close($conn);
?>


