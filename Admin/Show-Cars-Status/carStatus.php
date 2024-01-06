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
echo "Connected successfully"."<br>";


$date=$_POST["date"];

$sql = "SELECT c.brand, c.model, c.year, c.color, c.plate_id,
    CASE
        WHEN o.plate_id IS NOT NULL THEN 2 
        WHEN r.plate_id IS NOT NULL THEN 1 
        ELSE 0 
    END AS status
    FROM car c
    LEFT JOIN out_of_service o ON c.plate_id = o.plate_id
        AND '$date' BETWEEN o.startDate AND o.endDate
    LEFT JOIN reservation r ON c.plate_id = r.plate_id
        AND '$date' BETWEEN r.reserve_date AND r.return_date";

$result = mysqli_query($conn, $sql);

if ($result) {
    $carStatus = array();

    while ($row = mysqli_fetch_assoc($result)) {
        // Store car details and status in an associative array
        $carDetails = array(
            'brand' => $row['brand'],
            'model' => $row['model'],
            'year' => $row['year'],
            'color' => $row['color'],
            'plate_id' => $row['plate_id'],
            'status' => $row['status']
        );

        // Push car details and status to the array
        $carStatus[] = $carDetails;
    }

    session_start();
    // Store the array in the session variable
    $_SESSION['carStatus'] = $carStatus;

    header("Location: viewCarsStatus.php"); 
    exit();
} 
else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>