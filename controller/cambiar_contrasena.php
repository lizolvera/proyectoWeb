<?php
session_start();
require 'conexion.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['email_recuperacion']) || !isset($_SESSION['verificacion_exitosa'])) {
        header("Location: ../html/verificarCorreo.html?error=Sesión expirada, inicia de nuevo");
        exit();
    }

    $email = $_SESSION['email_recuperacion'];
    $nueva_contrasena = trim($_POST['password']);
    $confirmar_contrasena = trim($_POST['confirm-password']);

    // Verificar que ambas contraseñas coinciden
    if ($nueva_contrasena !== $confirmar_contrasena) {
        header("Location: ../html/cambiarContrasenia.html?error=Las contraseñas no coinciden");
        exit();
    }

    // Encriptar la nueva contraseña
    $contrasena_encriptada = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

    // Actualizar la contraseña en la base de datos
    $stmt = $conn->prepare("UPDATE usuarios SET PASSWORD = ? WHERE email = ?");
    $stmt->bind_param("ss", $contrasena_encriptada, $email);

    if ($stmt->execute()) {
        // Eliminar variables de sesión y redirigir al login
        session_unset();
        session_destroy();
        header("Location: ../html/login.html?success=Contraseña actualizada con éxito, inicia sesión");
        exit();
    } else {
        header("Location: ../html/cambiarContrasenia.html?error=Error al actualizar la contraseña");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../html/cambiarContrasenia.html");
    exit();
}
