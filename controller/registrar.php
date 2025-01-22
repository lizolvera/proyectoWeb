<?php
include 'conexion.php';

// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $apaterno = $_POST['ap'];
    $amaterno = $_POST['am'];
    $nombredeusuario = $_POST['username'];
    $correo_electronico = $_POST['email'];
    $contrasena = $_POST['password'];
    $confirm_contrasena = $_POST['confirm-password'];
    $telefono = $_POST['telefono'];
    $pregunta_secreta = $_POST['pregunta-secreta'];
    $respuesta_secreta = $_POST['respuesta-secreta'];

    // Validar contraseñas
    if ($contrasena !== $confirm_contrasena) {
        die("Las contraseñas no coinciden. Por favor, intenta de nuevo.");
    }

    // Encriptar la contraseña con password_hash
    $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Encriptar la respuesta secreta también (opcional)
    $respuesta_secreta_encriptada = password_hash($respuesta_secreta, PASSWORD_DEFAULT);

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, username, email, password, telefono, pSecreta, rSecreta) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssss", 
        $nombre, 
        $apaterno, 
        $amaterno, 
        $nombredeusuario, 
        $correo_electronico, 
        $contrasena_encriptada, 
        $telefono, 
        $pregunta_secreta, 
        $respuesta_secreta_encriptada
    );

    if ($stmt->execute()) {
        echo "Nuevo usuario registrado exitosamente.";
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
