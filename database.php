<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "gastar";

$db = new mysqli($host, $user, $pass, $dbname);
if ($db->connect_error) {
    die("Conexion fallida :V: " . $db->connect_error);
}
?>