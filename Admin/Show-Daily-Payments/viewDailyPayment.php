<?php
session_start();
if (isset($_SESSION['dailyPayments']) && is_array($_SESSION['dailyPayments']) && count($_SESSION['dailyPayments']) > 0) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daily Payments</title>
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
    <div class="container">
        <h1>Daily Payments</h1>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Payments</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($_SESSION['dailyPayments'] as $date => $payment) {
                    echo "<tr>";
                    echo "<td style = 'text-align: center;' >{$date}</td>";
                    echo "<td style = 'text-align: center;'>{$payment}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
} else {
    echo "No payments found for this period.";
}
?>
