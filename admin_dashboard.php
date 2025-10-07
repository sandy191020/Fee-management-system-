<?php
require 'config.php';
if(!isset($_SESSION['admin_id'])){ header('Location: admin_login.php'); exit; }

// stats
$total = $conn->query("SELECT COUNT(*) as c FROM students")->fetch_assoc()['c'];
$collected = $conn->query("SELECT SUM(amount) as s FROM payments WHERE status='paid'")->fetch_assoc()['s'];
if(!$collected) $collected = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - VIT</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background-color: #f6f9fc;
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
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">VIT Admin</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link btn btn-theme text-white me-2" href="add_student.php">Add Student</a></li>
                <li class="nav-item"><a class="nav-link btn btn-theme text-white me-2" href="analytics.php">Analytics</a></li>
                <li class="nav-item"><a class="nav-link btn btn-theme text-white" href="export_csv.php">Export CSV</a></li>
                <li class="nav-item"><a class="nav-link btn btn-danger text-white ms-2" href="admin_logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <h5>Total Students</h5>
                <h2><?php echo $total; ?></h2>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <h5>Total Fees Collected</h5>
                <h2>₹<?php echo number_format($collected,2); ?></h2>
            </div>
        </div>
    </div>

    <h3 class="mb-3">All Students</h3>
    <div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>USN</th>
                <th>Name</th>
                <th>Branch</th>
                <th>Year</th>
                <th>Fee</th>
                <th>Due</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $q = $conn->query("SELECT s.*, (s.fee_amount - IFNULL((SELECT SUM(amount) FROM payments p WHERE p.student_id=s.id AND p.status='paid'),0)) as pending FROM students s ORDER BY s.created_at DESC");
        while($r = $q->fetch_assoc()){
            echo '<tr>';
            echo '<td>'.$r['usn'].'</td>';
            echo '<td>'.$r['name'].'</td>';
            echo '<td>'.$r['branch'].'</td>';
            echo '<td>'.$r['year'].'</td>';
            echo '<td>₹'.number_format($r['fee_amount'],2).'</td>';
            echo '<td>₹'.number_format($r['pending'],2).'</td>';
            echo '<td><a href="edit_student.php?id='.$r['id'].'" class="btn btn-sm btn-theme">Edit</a></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
