<?php
session_start();
include('database.php');

if (isset($_POST['add-category-submit'])) {
  $CategoryName = mysqli_real_escape_string($db, $_POST['category-name']);
  $userId = $_SESSION['detsuid'];

  // Usamos prepared statements para prevenir ataques de inyeccion SQL
  $stmt = $db->prepare("INSERT INTO tblcategory (CategoryName, UserId) VALUES (?, ?)");
  $stmt->bind_param("si", $CategoryName, $userId);
  $result = $stmt->execute();

  if ($result) {
    $message = "Categoria agregada exitosamente!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo " <script type='text/javascript'>window.location.href = 'add-expenses.php';</script>";
    exit();
  } else {
    // Error agregando categoria
    echo "Error: " . mysqli_error($db);
  }
}
?>
