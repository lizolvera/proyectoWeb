<?php
require_once 'conexion.php';
session_start();

// Verificar que el email existe en la sesión
if (!isset($_SESSION['email_recuperacion'])) {
    header("Location: /controller/recuperar.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email_recuperacion'];
    $nueva_password = $_POST['nueva_password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar si las contraseñas coinciden
    if ($nueva_password !== $confirm_password) {
        die("Las contraseñas no coinciden. Por favor, intenta de nuevo.");
    }

    // Encriptar la nueva contraseña
    $password_encriptada = password_hash($nueva_password, PASSWORD_DEFAULT);

    // Actualizar la contraseña en la base de datos
    $query = $conn->prepare("UPDATE usuarios SET contrasena = ? WHERE correo_electronico = ?");
    $query->bind_param("ss", $password_encriptada, $email);

    if ($query->execute()) {
        echo "Contraseña actualizada exitosamente.";
        // Eliminar la sesión de recuperación
        unset($_SESSION['email_recuperacion']);
        // Redirigir a la página de inicio de sesión
        header("Location: /login.php");
        exit();
    } else {
        echo "Error al actualizar la contraseña: " . $query->error;
    }

    $query->close();
    $conn->close();
}
?>
