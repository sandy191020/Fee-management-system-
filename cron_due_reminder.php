<?php
include 'config.php';


// select students with pending fees (not paid in last 30 days)
$sql = "SELECT s.id, s.name, s.email, s.fees FROM students s
LEFT JOIN payments p ON s.id = p.student_id
WHERE p.id IS NULL OR p.date < (NOW() - INTERVAL 30 DAY)";


$res = $conn->query($sql);


while ($row = $res->fetch_assoc()) {
$to = $row['email'];
$subject = "Fee Payment Reminder";
$msg = "Dear ".$row['name'].", your fee of Rs.".$row['fees']." is due. Please pay at the earliest.";


mail($to, $subject, $msg);
}
?>