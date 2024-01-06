<?php
session_start();

if (isset($_SESSION['history_data']) && !empty($_SESSION['history_data'])) {
    $history_data = $_SESSION['history_data']; // Retrieve car data from the session
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Cars</title>
    <style>
        html {
            background-color: black;
        }
        .done {
            background-color: green;
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
        h1 {
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            text-align: center;
            background-color: green;
            margin: 0px;
        }
        th {
            color: #FFD700;
            background-color: black;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <div class="done">
        <h1>Reservations</h1>

        <table>
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Color</th>
                    <th>Reserve Date</th>
                    <th>Pick Up Date</th>
                    <th>Return Date</th>
                    <th>Cancellation</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($history_data as $history) {
                    echo "<tr>";
                    echo "<td>" . $history['brand'] . "</td>";
                    echo "<td>" . $history['model'] . "</td>";
                    echo "<td>" . $history['year'] . "</td>";
                    echo "<td>" . $history['color'] . "</td>";
                    echo "<td>" . $history['reserve_date'] . "</td>";
                    echo "<td>" . $history['pickup_date'] . "</td>";
                    echo "<td>" . $history['return_date'] . "</td>";
                    echo "<td>";
                    // Add a button to delete the reservation if it's after the current date
                    if (strtotime($history['return_date']) > time()) {
                        echo "<form action='../Delete/deleteReservation.php' method='POST'>";
                        echo "<input type='hidden' name='reservationId' value='" . $history['reservation_id'] . "'>";
                        echo "<input type='submit' style ='color: #FFD700; background-color: black;' value='Delete rservation'>";
                        echo "</form>";
                    
                    } else {
                        //echo "<td></td>"; // Empty cell for past reservations
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function deleteReservation(reservationId) {
            // You can use JavaScript or AJAX to handle the deletion here
            // For simplicity, an alert is used to show the reservation ID to be deleted
            var confirmation = confirm("Are you sure you want to delete reservation ID " + reservationId + "?");
            if (confirmation) {
                // Perform the deletion action (you can use AJAX to communicate with the server)
                alert("Deleting reservation ID " + reservationId);
            }
        }
    </script>
</body>
</html>

<?php
unset($_SESSION['history_data']);
} else {
    echo "No data available.";
}
?>