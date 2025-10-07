<?php
session_start();
date_default_timezone_set('Asia/Kolkata');


// DB config
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS',''); // XAMPP default
define('DB_NAME','demo_fees');


// Razorpay (test) - replace these with your test keys
define('RAZOR_KEY','YOUR_RAZORPAY_KEY');
define('RAZOR_SECRET','YOUR_RAZORPAY_SECRET');


// Email settings (optional)
define('SMTP_HOST','smtp.gmail.com');
define('SMTP_USER','yourdemo@gmail.com');
define('SMTP_PASS','yourappspecificpassword');


// Connect
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) die('DB Conn Error: ' . $conn->connect_error);


function random_password($length=8){
$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$str = '';
for ($i=0;$i<$length;$i++) $str .= $chars[rand(0, strlen($chars)-1)];
return $str;
}


function send_email($to, $subject, $message){
// Simple mail() demo. For reliable delivery use PHPMailer with SMTP (instructions below).
$headers = "From: demo@college.com\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
return @mail($to, $subject, $message, $headers);
}


?>