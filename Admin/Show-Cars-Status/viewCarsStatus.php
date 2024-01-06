<?php
session_start();

// Check if the car status data is available in the session
if (isset($_SESSION['carStatus']) && is_array($_SESSION['carStatus'])) {
    $carStatusData = $_SESSION['carStatus'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Car Status</title>
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
    <h1>Car Status</h1>

    <table>
        <thead>
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>Year</th>
                <th>Color</th>
                <th>Plate ID</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Loop through the car status data and create table rows
                foreach ($carStatusData as $carData) {
                    echo "<tr>";
                    echo "<td>{$carData['brand']}</td>";
                    echo "<td>{$carData['model']}</td>";
                    echo "<td>{$carData['year']}</td>";
                    echo "<td>{$carData['color']}</td>";
                    echo "<td>{$carData['plate_id']}</td>";
                    echo "<td>";

                    // Display corresponding status labels
                    if ($carData['status'] == 2) {
                        echo "Out Of Service";
                    } elseif ($carData['status'] == 1) {
                        echo "Reserved";
                    } else {
                        echo "Available";
                    }

                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
    // Clear the session data after displaying
    unset($_SESSION['carStatus']);
} else {
    // Handle case when car status data is not available in the session
    echo "";
}
?>
A7A