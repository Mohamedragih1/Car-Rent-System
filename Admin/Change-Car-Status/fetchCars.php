<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database_name = "Car_Rental_System";


    $conn = mysqli_connect($servername, $username, $password, $database_name);

    if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch distinct car brands based on the selected city
    $sql = "SELECT DISTINCT c.plate_id,c.brand,c.model,c.year,c.color,o.location
            FROM CAR c 
            JOIN office o ON c.office_id = o.office_id 
            ORDER BY o.location ASC;
           ";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options .= '<option value="' . $row['plate_id'] . '">'
            . $row['color'] . ' ' . $row['brand'] . ' ' . $row['model'] . ' ' . $row['year'] . ' at ' . $row['location'] . '</option>';
        }
    }

    echo $options;

    $conn->close();
?>