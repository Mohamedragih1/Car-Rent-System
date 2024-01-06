<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>Reservation Confirmation</title>
    <link
    rel="stylesheet"
    href="./styles2.css"
    >
    <script src="./script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <div class="container-class d-flex flex-column align-items-start justify-content-start gap-2">
    <h1>Reservation</h1>
    <div class="php-container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database_name = "Car_Rental_System";
        
        
        $conn = mysqli_connect($servername, $username, $password, $database_name);
        
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        

        session_start();
        if (isset($_POST['plate_id']) || isset($_SESSION['plate_id'])) 
        {
            
            if (isset($_POST['plate_id'])) 
                $_SESSION['plate_id'] = $_POST['plate_id'];
            $plate_id=$_SESSION['plate_id'];
            $sql = "SELECT brand,model,year,color
                        FROM car 
                        WHERE plate_id = '$plate_id'";
            $result = mysqli_query($conn, $sql);
            $carDetails =mysqli_fetch_assoc($result);
        
            if ($carDetails) {
                echo "<h2>Brand: " . $carDetails['brand'] . "</h2><br>";
                echo "<h2>Model: " . $carDetails['model'] . "</h2><br>";
                echo "<h2>Year: " . $carDetails['year'] . "</h2><br>";
                echo "<h2>Color: " . $carDetails['color'] . "</h2><br>";
            }
            $sql="select return_date, pickup_date 
                FROM reservation WHERE
                plate_id = '$plate_id' AND (pickup_date >= CURDATE() OR return_date >= CURDATE());";
            $result = mysqli_query($conn, $sql);
            $_SESSION['dates_array'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $result = mysqli_query($conn, $sql);
            while ($reserveDetails =mysqli_fetch_assoc($result)) {
                    echo "<h2>This car is reserved from " . $reserveDetails['pickup_date'] . " to " . $reserveDetails['return_date'] . "</h2>";   
            }
                
                
            } 
            else 
            {
                echo "Error";
            }
       
        
        ?>
    </div>

<!-- Form for pickup and return dates -->
<form method="post" action="confirmReservation.php">
    <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Choose Pick up Date</label>
        <input type="date" class="form-control" id="formGroupExampleInput" name="pickupDate"  placeholder="">
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Choose return Date</label>
        <input type="date" class="form-control" id="formGroupExampleInput2" name="returnDate" placeholder="">
    </div>
    <button type="submit" class="btn btn-primary">Submit Reservation</button>
</form>

</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</body>
</html>