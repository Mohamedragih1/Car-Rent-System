<?php
session_start();

// Check if reservation information is available in the session
if (isset($_SESSION['carReservationInfo']) && is_array($_SESSION['carReservationInfo'])) {
    $reservationInfo = $_SESSION['carReservationInfo'];

    // Extracting the unique details for the title
    $firstReservation = reset($reservationInfo);
    $title = "All Reservations for {$firstReservation['color']} {$firstReservation['brand']} {$firstReservation['model']} {$firstReservation['year']} ({$firstReservation['plate_id']})";
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Reservations</title>
    <style>
         html{
            background-color: black;
        }
        .done{
            background-color: orange;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #FFD700;
            margin: 0px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        h1{
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            text-align:center;
            background-color: orange;
            margin: 0px;
        }
        th{
            color: #FFD700;
            background-color: black;
        }
    </style>
</head>
<body>
    <h1><?php echo $title; ?></h1>

    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>SSN</th>
                <th>Reservation Date</th>
                <th>Pickup Date</th>
                <th>Return Date</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Loop through reservation information and create table rows
                foreach ($reservationInfo as $reservation) {
                    echo "<tr>";
                    echo "<td>{$reservation['fname']}</td>";
                    echo "<td>{$reservation['lname']}</td>";
                    echo "<td>{$reservation['ssn']}</td>";
                    echo "<td>{$reservation['reserve_date']}</td>";
                    echo "<td>{$reservation['pickup_date']}</td>";
                    echo "<td>{$reservation['return_date']}</td>";
                    echo "<td>{$reservation['price']}</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
    // Clear the session data after displaying
    unset($_SESSION['reservationInfo']);
} else {
    // Handle case when reservation information is not available in the session
    echo "No reservation information available.";
}
?>
