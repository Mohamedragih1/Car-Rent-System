<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database_name = "Car_Rental_System";
    
    
    $conn = mysqli_connect($servername, $username, $password, $database_name);
    
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    session_start(); // Start the session

    // Check if the user is logged in (check for session data)
    if (isset($_SESSION['ssn'])) 
        $ssn = $_SESSION['ssn'];

    $sql = "SELECT r.reservation_id,r.reserve_date,r.pickup_date,r.return_date,c.brand,c.model,c.year,c.color
        FROM reservation AS r
        JOIN car AS c ON r.plate_id = c.plate_id
        WHERE r.ssn = '$ssn'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) 
    {
            // Fetch the car details and store them in a session variable
      $history_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
      $_SESSION['history_data'] = $history_data;

      header("Location: viewhistory.php");
      exit();
    }
    echo("<script>window.location = 'viewhistory.php';</script>");

        mysqli_close($conn);
?>