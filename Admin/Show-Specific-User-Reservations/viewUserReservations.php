<?php
session_start();

// Check if reservation information is available in the session
if (isset($_SESSION['userReservationInfo']) && is_array($_SESSION['userReservationInfo'])) {
    $reservationInfo = $_SESSION['userReservationInfo'];

    // Extracting the unique details for the title
    $firstReservation = reset($reservationInfo);
    $title = "Reservations for {$firstReservation['fname']} {$firstReservation['lname']} [{$firstReservation['ssn']}]";
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
                <th>Brand</th>
                <th>Model</th>
                <th>Year</th>
                <th>Color</th>
                <th>Plate ID</th>
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
                    echo "<td style = 'text-align: center;' >{$reservation['brand']}</td>";
                    echo "<td style = 'text-align: center;' >{$reservation['model']}</td>";
                    echo "<td style = 'text-align: center;' >{$reservation['year']}</td>";
                    echo "<td style = 'text-align: center;' >{$reservation['color']}</td>";
                    echo "<td style = 'text-align: center;' >{$reservation['plate_id']}</td>";
                    echo "<td style = 'text-align: center;' >{$reservation['reserve_date']}</td>";
                    echo "<td style = 'text-align: center;' >{$reservation['pickup_date']}</td>";
                    echo "<td style = 'text-align: center;' >{$reservation['return_date']}</td>";
                    echo "<td style = 'text-align: center;' >{$reservation['price']}</td>";
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
