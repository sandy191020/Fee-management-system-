
<?php
require 'config.php';
if(!isset($_SESSION['student_id'])){ 
    header('Location: student_login.php'); 
    exit; 
}

$student_id = $_SESSION['student_id'];

// fetch student details
$q = $conn->prepare("SELECT s.*, 
    (s.fee_amount - IFNULL((SELECT SUM(amount) FROM payments p WHERE p.student_id=s.id AND p.status='paid'),0)) as pending 
    FROM students s WHERE s.id=?");
$q->bind_param("i",$student_id);
$q->execute();
$res = $q->get_result();
$student = $res->fetch_assoc();
if(!$student){
    echo "Student not found!";
    exit;
}

// handle payment form submission (demo purpose)
if($_SERVER['REQUEST_METHOD']==='POST'){
    $amount = $_POST['amount'];
    if($amount > 0 && $amount <= $student['pending']){
        $stmt = $conn->prepare("INSERT INTO payments(student_id, amount, status, created_at) VALUES(?,?, 'paid', NOW())");
        $stmt->bind_param("id",$student_id,$amount);
        $stmt->execute();
        header("Location: student_pay.php?success=1");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Payment - VIT</title>
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
        <a class="navbar-brand" href="#">VIT Student</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link btn btn-danger text-white ms-2" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Payment Successful!</div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card shadow-sm p-4">
                <h4 class="mb-3">Welcome, <?php echo htmlspecialchars($student['name']); ?></h4>
                <p><strong>USN:</strong> <?php echo $student['usn']; ?></p>
                <p><strong>Total Fee:</strong> ₹<?php echo number_format($student['fee_amount'],2); ?></p>
                <p><strong>Pending Due:</strong> ₹<?php echo number_format($student['pending'],2); ?></p>

                <?php if($student['pending'] > 0): ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Enter Amount to Pay</label>
                        <input type="number" class="form-control" name="amount" id="amount" max="<?php echo $student['pending']; ?>" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-theme">Pay Now</button>
                </form>
                <?php else: ?>
                <div class="alert alert-info mt-3">No pending fees. All clear ✅</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>