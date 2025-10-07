<?php
session_start();
include 'config.php';
if (!isset($_SESSION['student_id'])) header("Location: student_login.php");


$id = $_SESSION['student_id'];
$payment_id = $_GET['payment_id'];


$res = $conn->query("SELECT * FROM students WHERE id=$id");
$student = $res->fetch_assoc();


$payRes = $conn->query("SELECT * FROM payments WHERE student_id=$id ORDER BY date DESC LIMIT 1");
$payment = $payRes->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<title>Receipt</title>
</head>
<body>
<h2>Payment Receipt</h2>
<p>Name: <?php echo $student['name']; ?></p>
<p>Branch: <?php echo $student['branch']; ?></p>
<p>Year: <?php echo $student['year']; ?></p>
<p>Amount Paid: <?php echo $payment['amount']; ?></p>
<p>Status: <?php echo $payment['status']; ?></p>
<p>Payment ID: <?php echo $payment_id; ?></p>
<p>Date: <?php echo $payment['date']; ?></p>
<button onclick="window.print()">Download Receipt</button>
</body>
</html>