<?php
$host = "sql109.infinityfree.com";
$user = "if0_37224381";
$pass = "Mew5cFiXoHoCxN";
$dbname = "if0_37224381_gastar";

$db = new mysqli($host, $user, $pass, $dbname);
if ($db->connect_error) {
    die("Conexion fallida: " . $db->connect_error);
}
?>