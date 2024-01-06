<?php
session_start();

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
echo "Connected successfully" . "<br>";

$startDate = $_POST["startDate"];
$endDate = $_POST["endDate"];

$sql = "SELECT c.brand, c.model, c.year, c.color, c.plate_id,
        u.fname, u.lname, u.ssn,
        r.reserve_date, r.pickup_date, r.return_date, r.price
        FROM reservation r
        INNER JOIN car c ON r.plate_id = c.plate_id
        INNER JOIN users u ON r.ssn = u.ssn
        WHERE r.reserve_date BETWEEN '$startDate' AND '$endDate'";

$result = mysqli_query($conn, $sql);

if ($result) {
    $reservationInfo = array();

    while ($row = mysqli_fetch_assoc($result)) {
        // Store reservation details in an associative array
        $reservationDetails = array(
            'brand' => $row['brand'],
            'model' => $row['model'],
            'year' => $row['year'],
            'color' => $row['color'],
            'plate_id' => $row['plate_id'],
            'fname' => $row['fname'],
            'lname' => $row['lname'],
            'ssn' => $row['ssn'],
            'reserve_date' => $row['reserve_date'],
            'pickup_date' => $row['pickup_date'],
            'return_date' => $row['return_date'],
            'price' => $row['price']
        );

        // Push reservation details to the array
        $reservationInfo[] = $reservationDetails;
    }

    session_start();

    // Store the array in the session variable
    $_SESSION['reservationInfo'] = $reservationInfo;

    header("Location: viewReservations.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
