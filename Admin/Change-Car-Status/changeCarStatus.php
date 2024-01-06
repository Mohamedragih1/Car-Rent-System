<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database_name = "Car_Rental_System";

    $conn = mysqli_connect($servername, $username, $password, $database_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $status = $_POST["status"];
    $plate_id = $_POST["Car"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    // ... (Previous code remains unchanged)

    // Check if the car is reserved
    $sql_check_reservation = "SELECT * 
    FROM reservation
    WHERE plate_id = '$plate_id' 
    AND CURDATE() BETWEEN reserve_date AND return_date";
    $result_check_reservation = mysqli_query($conn, $sql_check_reservation);

    if (mysqli_num_rows($result_check_reservation) > 0) {
    // Car is currently reserved, cannot change status
    echo '<script>alert("Car is currently reserved and cannot be changed."); window.location.href = "index.html";</script>';
    } else {

    // Check if the car is available or out of service/reserved
    $sql_check_status = "SELECT * 
                         FROM out_of_service 
                         WHERE plate_id = '$plate_id' 
                         AND CURDATE() > startDate 
                         AND CURDATE() < endDate
                         ";
    $result_check_status = mysqli_query($conn, $sql_check_status);

    if ($status == 0) { // Admin chose 'Available'
        if (mysqli_num_rows($result_check_status) > 0) {
            // Car is out of service
            $sql_update_out_of_service = "UPDATE out_of_service SET endDate = CURDATE() WHERE plate_id = '$plate_id' AND CURDATE() > startDate AND CURDATE() < endDate";
            mysqli_query($conn, $sql_update_out_of_service);
            // Updated successfully
            echo '<script>alert("Car status changed: Out of service to Available."); window.location.href = "../Admin-Page/index.html";</script>';
    }

    else {
        // Car is already available
        echo '<script>alert("Car is already available."); window.location.href = "index.html";</script>';
        }
    }
    
    elseif ($status == 1) { // Admin chooses 'Out of service'
    $sql_check_existing = "SELECT * FROM out_of_service 
                           WHERE plate_id = '$plate_id' 
                           AND ('$startDate' BETWEEN startDate AND endDate OR '$endDate' BETWEEN startDate AND endDate)";

    $result_check_existing = mysqli_query($conn, $sql_check_existing);

    if (mysqli_num_rows($result_check_existing) > 0) {
        // Car is already out of service
        echo '<script>alert("Car is already out of service in this period."); window.location.href = "index.html";</script>';
    } else {
        // Car is not out of service, add to 'out_of_service' table
        $sql_add_out_of_service = "INSERT INTO out_of_service (plate_id, startDate, endDate) VALUES ('$plate_id', '$startDate', '$endDate')";
        mysqli_query($conn, $sql_add_out_of_service);
        // Inserted successfully
        echo '<script>alert("Car status changed: Available to Out of service."); window.location.href = "../Admin-Page/index.html";</script>';
        }
    }
}
mysqli_close($conn);
?>