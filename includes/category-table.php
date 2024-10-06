<?php
session_start();
$userid = $_SESSION['detsuid'];

$db = mysqli_connect("sql109.infinityfree.com", "if0_37224381", "Mew5cFiXoHoCxN", "if0_37224381_gastar");

if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT category, SUM(ExpenseCost) AS total_expense FROM tblexpense WHERE UserId = ? GROUP BY category";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "i", $userid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
  $data[] = array(
    'category' => $row['category'],
    'total_expense' => $row['total_expense'],
  );
}

$total_expense = array_reduce($data, function($acc, $item) {
  return $acc + $item['total_expense'];
});

foreach ($data as &$item) {
  $item['percentage'] = ($item['total_expense'] / $total_expense) * 100;
}
?>