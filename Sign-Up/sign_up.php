<?php
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "Car_Rental_System";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database_name);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $fname=$_POST["name"];
    $lname=$_POST["Surname"];
    $ssn = $_POST["SSN"];
    $phone_no = $_POST["phone"];

    $sql = "SELECT * FROM users WHERE email = '$email' OR ssn='$ssn' OR phone_no='$phone_no'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
       
        $count = mysqli_num_rows($result);

        if ($count >0) {
            echo '<script>alert("E-mail or SSN already exists")</script>';
            echo("<script>window.location = 'index.html';</script>");
        } else {
            $query = "INSERT INTO users (`email`, `password`, `fname`, `lname`, `ssn`, `phone_no`, `isAdmin`) VALUES ('$email', '$password', '$fname', '$lname', '$ssn', '$phone_no', 0);";
            $result = mysqli_query($conn,$query);
            echo '<script>alert("Account created successfully")</script>';
            echo("<script>window.location = '../Sign-In/Customer-Sign-In/index.html';</script>");
        }
    } 
    else {
        echo "Error: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>