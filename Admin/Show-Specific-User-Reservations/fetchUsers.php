<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database_name = "Car_Rental_System";


    $conn = mysqli_connect($servername, $username, $password, $database_name);

    if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT u.fname,u.lname,u.ssn
            FROM USERS u
            ORDER BY u.fname ASC;
           ";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options .= '<option value="' . $row['ssn'] . '">'
          . $row['fname'] . ' ' . $row['lname'] . ' [' . $row['ssn'] . ']' . '</option>';
        }
    }

    echo $options;

    $conn->close();
?>