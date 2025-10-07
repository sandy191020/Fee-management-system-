<?php
include 'config.php';


header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=payments_report.csv');


$output = fopen('php://output', 'w');
fputcsv($output, array('Student ID', 'Amount', 'Status', 'Date'));


$res = $conn->query("SELECT * FROM payments");
while ($row = $res->fetch_assoc()) {
fputcsv($output, $row);
}
fclose($output);
?>