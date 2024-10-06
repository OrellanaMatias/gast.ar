<?php
session_start();
include('database.php');

if (isset($_POST['update_user'])) {

    $userid = $_SESSION['detsuid'];
    $username = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $update_query = "UPDATE users SET name='$username', email='$email' , phone='$phone' WHERE id=$userid";
    $result = mysqli_query($db, $update_query);
    if ($result) {
        $message = "Perfil actualizado exitosamente!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo " <script type='text/javascript'>window.location.href = 'user_profile.php';</script>";
        exit();
    } else {
        echo "Error actualizando informacion del usuario: " . mysqli_error($db);
    }
}

?>