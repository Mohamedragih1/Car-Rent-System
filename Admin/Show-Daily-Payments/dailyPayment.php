<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database_name = "Car_Rental_System";

    $conn = new mysqli($servername, $username, $password, $database_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];

    $sql = "SELECT reserve_date, SUM(price) AS dailyPayment 
              FROM reservation 
              WHERE reserve_date BETWEEN '$startDate' AND '$endDate' 
              GROUP BY reserve_date";

    $result = mysqli_query($conn, $sql);
    $dailyPayments = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dailyPayments[$row['reserve_date']] = $row['dailyPayment'];
        }
    }

    session_start();
    $_SESSION['dailyPayments'] = $dailyPayments;

    $conn->close();

    // Redirect to viewDailyPayment.php
    header("Location: viewDailyPayment.php");
    exit();
?>
