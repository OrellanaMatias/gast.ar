<?php
session_start();
if (isset($_SESSION['detsuid'])) {
    $userid = $_SESSION['detsuid'];
} 

include_once 'database.php';

if (isset($_POST['expense-id'])) {
  $userid = $_SESSION['detsuid'];
  $id = isset($_POST['expense-id']) ? $_POST['expense-id'] : '';
  
  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $date = isset($_POST['date_of_lending']) ? $_POST['date_of_lending'] : '';
  $description = isset($_POST['description']) ? $_POST['description'] : '';
  $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
  $status = isset($_POST['status']) ? $_POST['status'] : '';

  $stmt = $db->prepare('UPDATE lending SET name = ?, date_of_lending = ?, description = ?, amount = ?, status = ? WHERE id = ? AND UserId = ?');
  $stmt->bind_param('ssssssi', $name, $date, $description, $amount, $status, $id, $userid);
  $result = $stmt->execute();

  if ($result) {
    $message = "Prestamo actualizado exitosamente!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo " <script type='text/javascript'>window.location.href = 'manage-lending.php';</script>";
    exit();
  } else {
    $message = "Intente nuevamente!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo " <script type='text/javascript'>window.location.href = 'manage-lending.php?id=' . $id';</script>";
    exit();
  }
}
?>