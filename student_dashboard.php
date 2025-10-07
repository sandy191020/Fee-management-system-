<?php
include 'config.php';
if (!isset($_SESSION['student_id'])) header("Location: student_login.php");

$id = $_SESSION['student_id'];
$res = $conn->query("SELECT * FROM students WHERE id=$id");
$student = $res->fetch_assoc();

// Total fee and pending fee
$total_fee = isset($student['fee_amount']) ? $student['fee_amount'] : 0;
$paid_amount = $conn->query("SELECT SUM(amount) as total_paid FROM payments WHERE student_id=$id AND status='paid'")->fetch_assoc()['total_paid'];
$paid_amount = $paid_amount ? $paid_amount : 0;
$pending_fee = $total_fee - $paid_amount;

// Get payment history
$payments = $conn->query("SELECT * FROM payments WHERE student_id=$id ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard - VIT</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background-color: #f6f9fc;
    font-family: 'Segoe UI', sans-serif;
}
.navbar {
    margin-bottom: 20px;
}
.card {
    border-radius: 10px;
}
.table thead th {
    background-color: #5369f8;
    color: #fff;
}
.table tbody tr:hover {
    background-color: #e9f0ff;
}
.btn-theme {
    background-color: #5369f8;
    border-color: #5369f8;
    color: #fff;
}
.btn-theme:hover {
    background-color: #3f51d1;
}
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">VIT Student</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link btn btn-theme text-white me-2" href="student_pay.php">Pay Fees</a></li>
                <li class="nav-item"><a class="nav-link btn btn-danger text-white" href="logout_admin.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm p-4 text-center">
                <h5>Name</h5>
                <h4><?php echo htmlspecialchars($student['name']); ?></h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-4 text-center">
                <h5>Branch & Year</h5>
                <h4><?php echo htmlspecialchars($student['branch']).' - '.htmlspecialchars($student['year']); ?></h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-4 text-center">
                <h5>Fees</h5>
                <p>Total: ₹<?php echo number_format($total_fee,2); ?></p>
                <p>Paid: ₹<?php echo number_format($paid_amount,2); ?></p>
                <p>Pending: ₹<?php echo number_format($pending_fee,2); ?></p>
            </div>
        </div>
    </div>

    <h3 class="mb-3">Payment History</h3>
    <div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if($payments && $payments->num_rows > 0){
            while($p = $payments->fetch_assoc()){
                echo '<tr>';
                echo '<td>₹'.number_format($p['amount'],2).'</td>';
                echo '<td>'.htmlspecialchars($p['status']).'</td>';
                echo '<td>'.htmlspecialchars($p['created_at']).'</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="3" class="text-center">No payments found yet.</td></tr>';
        }
        ?>
        </tbody>
    </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
