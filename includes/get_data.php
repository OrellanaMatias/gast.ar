<?php
session_start();
if (!$db) {
  die("Conexion fallida: " . mysqli_connect_error());
}

$userid=$_SESSION['detsuid'];
$query=mysqli_query($db,"SELECT ExpenseDate, SUM(ExpenseCost) as total_cost FROM tblexpense WHERE UserId='$userid' AND ExpenseDate > DATE_SUB(NOW(), INTERVAL 30 DAY) GROUP BY ExpenseDate");
$data = array();
while ($result = mysqli_fetch_array($query)) {
  $data[] = array(strtotime($result['ExpenseDate']) * 1000, (float)$result['total_cost']);
}

echo json_encode($data);
?>
