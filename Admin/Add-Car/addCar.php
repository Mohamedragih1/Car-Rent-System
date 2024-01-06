<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database_name = "Car_Rental_System";

    $conn = mysqli_connect($servername, $username, $password, $database_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $brand = $_POST["brand"];
    $model = $_POST["model"];
    $year = $_POST["year"];
    $plateId = $_POST["plateId"];
    $color = $_POST["color"];
    $price = $_POST["price"];
    $mileage = $_POST["mileage"];
    $location = $_POST["Location"];

    $sql = "INSERT INTO `car` (`plate_id`, `brand`, `model`, `year`, `pricePerDay`, `color`, `miles`, `office_id`) 
        VALUES ('$plateId', '$brand', '$model', '$year', '$price', '$color', '$mileage', '$location')";

    try {
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo '<script>alert("Car inserted successfully");</script>';
            echo '<script>window.location = "../Admin-Page/index.html";</script>';
        } else {
            echo '<script>alert("An error occurred while inserting the car");</script>';
            echo '<script>window.location = "index.html";</script>';
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 1062) {
            echo '<script>alert("Plate ID already exists");</script>';
            echo '<script>window.location = "index.html";</script>';
        }
    }
?>