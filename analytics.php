<?php

include 'config.php';

// Session check for admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// fees collected by branch
$branchData = [];
$sql = "SELECT s.branch, SUM(p.amount) as total 
        FROM payments p 
        JOIN students s ON p.student_id = s.id 
        GROUP BY s.branch";

$res = $conn->query($sql);

if(!$res){
    die("❌ Query Error: " . $conn->error);
}

while($row = $res->fetch_assoc()){
    $branchData[$row['branch']] = $row['total'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Analytics Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="container mt-5">
    <h2>Analytics Dashboard</h2>
    <a href="admin_dashboard.php" class="btn btn-secondary mb-3">⬅ Back to Dashboard</a>

    <?php if(empty($branchData)) { ?>
        <div class="alert alert-warning">⚠ No payment data available to display charts.</div>
    <?php } else { ?>
        <div class="card p-3 shadow">
            <canvas id="branchChart" width="400" height="200"></canvas>
        </div>

        <script>
        var ctx = document.getElementById('branchChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_keys($branchData)); ?>,
                datasets: [{
                    label: 'Fees Collected',
                    data: <?php echo json_encode(array_values($branchData)); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'top' },
                    title: { display: true, text: 'Fees Collected by Branch' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
        </script>
    <?php } ?>
</body>
</html>
