<?php
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "Car_Rental_System";


$conn = mysqli_connect($servername, $username, $password, $database_name);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    $email = $_POST["email"];
    $password = $_POST["password"];
    $isAdmin = $_POST["constant-value"];

   

   
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND isAdmin = '$isAdmin'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
       
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $ssn = $row['ssn'];
            }
            session_start();

            $_SESSION['ssn'] = $ssn;
            
            echo '<script>alert("Login successful")</script>';
            if($isAdmin == 0)
            echo("<script>window.location = '../Customer/Search/index.html';</script>");
            else
            echo("<script>window.location = '../Admin/Admin-Page/index.html';</script>");
        } else {
            echo '<script>alert("Login failed")</script>';
            if ($isAdmin == 1)
                echo("<script>window.location = 'Admin-Sign-In/index.html';</script>");
            else 
                echo("<script>window.location = 'Customer-Sign-In/index.html';</script>");
        }
    } 
    else {
        echo "Error: " . mysqli_error($conn);
    }
    
    
    mysqli_close($conn);
}
?>


