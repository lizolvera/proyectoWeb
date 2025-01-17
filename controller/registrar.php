<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre'];
    $apaterno = $_POST['ap'];
    $amaterno = $_POST['am'];
    $nombredeusuario = $_POST['username'];
    $correo_electronico = $_POST['email'];
    $contrasena = $_POST['password'];
    $telefono = $_POST['telefono'];

    $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, Apaterno, Amaterno, Nombredeusuario, correo_electronico, contrasena, telefono) 
            VALUES ('$nombre', '$apaterno', '$amaterno', '$nombredeusuario', '$correo_electronico', '$contrasena_encriptada', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo usuario registrado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
