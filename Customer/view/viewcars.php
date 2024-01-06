<?php
session_start();

if (isset($_SESSION['cars_data']) && !empty($_SESSION['cars_data'])) {
    $cars_data = $_SESSION['cars_data']; // Retrieve car data from the session
?>

<!DOCTYPE html>
<html >
<head>
    <title>Available Cars</title>
    <style>
        html{
            background-color: black;
        }
        .done{
            background-color:  orangered;
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
            margin: 0px;
        }
       
        h1{
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            text-align:center;
            background-color:  orangered;
            margin: 0px;
        }
        th{
            color: #FFD700;
            background-color: black;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class = "done">
    <h1>Available Cars</h1>

    <table>
        <thead>
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price Per Day</th>
                <th>Color</th>
                <th>Miles</th>
                <th>Plate ID</th>
                <th>Reservation</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($cars_data as $car) {
                    echo "<tr>";
                    echo "<td>" . $car['brand'] . "</td>";
                    echo "<td>" . $car['model'] . "</td>";
                    echo "<td>" . $car['year'] . "</td>";
                    echo "<td>" . $car['pricePerDay'] . "</td>";
                    echo "<td>" . $car['color'] . "</td>";
                    echo "<td>" . $car['miles'] . "</td>";
                    echo "<td>" . $car['plate_id'] . "</td>";
                    echo "<td>";

                    $endDate = date('Y-m-d', strtotime($car['endDate']));
                    $startDate = date('Y-m-d', strtotime($car['startDate']));
                    $currentDate = date('Y-m-d');
                    
                    if ($startDate <= $currentDate && $currentDate <= $endDate) {
                        echo "<h5 style = 'color:red;' >Out of service</h5>";
                    } else 
                    {
                        echo "<form action='../Make-Reservation/makeReservation.php' method='POST'>";
                        echo "<input type='hidden' name='plate_id' value='" . $car['plate_id'] . "'>";
                        echo "<input type='submit' style ='color: #FFD700; background-color: black;' value='Make Reservation'>";
                        echo "</form>";
                    }

                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
 </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

<?php
    unset($_SESSION['cars_data']);
} else {
    echo "No car data available.";
}
?>
