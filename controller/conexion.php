<?php
$host = 'localhost'; 
$usuario = 'root'; 
$clave = ''; 
$nombre_bd = 'registro_usuarios'; 

$conn = new mysqli($host, $usuario, $clave, $nombre_bd);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>