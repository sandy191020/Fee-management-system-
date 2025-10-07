<?php
session_start();
include 'config.php';
require('razorpay-php/Razorpay.php');


use Razorpay\Api\Api;


$api = new Api($razorpay_key, $razorpay_secret);


$attributes = [
'razorpay_order_id' => $_POST['razorpay_order_id'],
'razorpay_payment_id' => $_POST['razorpay_payment_id'],
'razorpay_signature' => $_POST['razorpay_signature']
];


try {
$api->utility->verifyPaymentSignature($attributes);


$id = $_SESSION['student_id'];
$amount = $_POST['amount'] / 100;


$stmt = $conn->prepare("INSERT INTO payments (student_id, amount, status) VALUES (?,?, 'Success')");
$stmt->bind_param("id", $id, $amount);
$stmt->execute();


header("Location: receipt.php?payment_id=".$_POST['razorpay_payment_id']);
} catch(Exception $e) {
echo "Payment Failed: ".$e->getMessage();
}
?>