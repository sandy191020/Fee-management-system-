<?php
session_start();
include 'config.php';
require('razorpay-php/Razorpay.php');


use Razorpay\Api\Api;


if (!isset($_SESSION['student_id'])) {
header("Location: student_login.php");
exit;
}


$id = $_SESSION['student_id'];
$res = $conn->query("SELECT * FROM students WHERE id=$id");
$student = $res->fetch_assoc();


$api = new Api($razorpay_key, $razorpay_secret);


$orderData = [
'receipt' => uniqid(),
'amount' => $student['fees'] * 100, // in paise
'currency' => 'INR',
'payment_capture' => 1
];


$order = $api->order->create($orderData);


$_SESSION['order_id'] = $order['id'];


echo json_encode(['order_id' => $order['id']]);
?>