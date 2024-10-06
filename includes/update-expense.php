<?php
session_start();
include('database.php');

if (isset($_POST['submit'])) {
  $userid = $_SESSION['detsuid'];
  $dateexpense = $_POST['dateexpense'];
  $category = $_POST['category'];
  $description = $_POST['description'];
  $costitem = $_POST['cost'];
  $expenseid = $_POST['expenseid'];
  $query = mysqli_query($db, "UPDATE tblexpense SET ExpenseDate='$dateexpense', category=(SELECT CategoryName FROM tblcategory WHERE CategoryId='$category'), ExpenseCost='$costitem', Description='$description' WHERE ID='$expenseid' AND UserId='$userid'");
  if ($query) {
    $message = "Gasto actualizado!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo " <script type='text/javascript'>window.location.href = 'manage-expenses.php';</script>";
  } else {
    $message = "El gasto no pudo ser actualizado :c";
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
}
?>
