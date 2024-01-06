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
    $sql = "SELECT DISTINCT office_id,location
            FROM office 
            ORDER BY office_id ASC;
           ";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options .= '<option value="' . $row['office_id'] . '">' . $row['location'] . '</option>';
        }
    }

    echo $options;

    $conn->close();
?>