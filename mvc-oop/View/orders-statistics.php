<?php

session_start();

$user_details = $_SESSION['logged_in_user'];
$user_role = $_SESSION['logged_in_user']['role'];

?>

<?php
    include_once "header.php";
    include_once "navigation-menu.php";

?>

<?php

include '../DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->getConnection();

// Query to retrieve the orders per month
$sql = "SELECT MONTH(order_date) AS month, COUNT(*) AS count
        FROM orders
        WHERE YEAR(order_date) = YEAR(NOW())
        GROUP BY MONTH(order_date)";

$result = $conn->query($sql);

// Format the data for Chart.js
$data = array(
    "labels" => array(),
    "data" => array()
);

while ($row = $result->fetch_assoc()) {
    $data["labels"][] = date("F", mktime(0, 0, 0, $row["month"], 1));
    $data["data"][] = $row["count"];
}

// Close the database connection
$conn->close();


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
    


<!-- Include the Chart.js library -->

<!-- Create a canvas element to hold the chart -->
<canvas id="orders-chart"></canvas>

<!-- Add JavaScript to generate the chart -->
<script>
var ctx = document.getElementById('orders-chart').getContext('2d');
var ordersChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($data["labels"]); ?>,
        datasets: [{
            label: 'Orders per Month',
            data: <?php echo json_encode($data["data"]); ?>
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>






</body>
</html>