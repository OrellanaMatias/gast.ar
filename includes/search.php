<?php
include 'database.php';
$searchQuery = $_POST['query'];
$limit = $_POST['limit'];
$sql = "SELECT * FROM tblexpense WHERE UserId='$userid' AND Description LIKE '%$searchQuery%' LIMIT $limit";
$result = mysqli_query($db, $sql);
if(mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo '<div class="expense">';
    echo '<h4>'.$row['Description'].'</h4>';
    echo '<p>Moto: '.$row['Amount'].'</p>';
    echo '<p>Fecha: '.$row['Date'].'</p>';
    echo '</div>';
  }
} else {
  echo '<p>No encontramos gastos.</p>';
}
?>
