<?php

session_start();

$user_details = $_SESSION['logged_in_user'];
$user_role = $_SESSION['logged_in_user']['role'];


include_once "header.php";
include_once "navigation-menu.php";

include '../DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->getConnection();

$sql = "SELECT DATE_FORMAT(order_date, '%Y-%m') as order_month, COUNT(*) as num_orders, SUM(total_cost) as total_cost FROM orders GROUP BY order_month ORDER BY order_month ASC";

$result = mysqli_query($conn, $sql);

$orderData = array();
if(mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $orderData['labels'][] = $row['order_month'];
    $orderData['data'][] = $row['num_orders'];
    $orderData['total_cost'][] = $row['total_cost'];
  }
}

$orderDataJSON = json_encode($orderData);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>All Orders Chart</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

  <canvas id="orderChart"></canvas>

  <script>
    // Retrieve the order data from PHP
    var orderData = <?php echo $orderDataJSON; ?>;

    // Create the chart
    var ctx = document.getElementById('orderChart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: orderData.labels,
        datasets: [{
          label: 'Number of Orders',
          data: orderData.data,
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        },
        {
          label: 'Total Cost',
          data: orderData.total_cost,
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
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
