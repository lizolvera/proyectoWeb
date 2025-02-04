<?php
session_start();
require 'conexion.php'; // Asegúrate de que este archivo conecta correctamente a tu base de datos.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['email_recuperacion'])) {
        header("Location: ../html/verificarCorreo.html?error=Sesión expirada, inicia de nuevo");
        exit();
    }

    $email = $_SESSION['email_recuperacion'];
    $respuesta_usuario = trim($_POST['rSecreta']);

    // Buscar la respuesta en la base de datos
    $stmt = $conn->prepare("SELECT rSecreta FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($respuesta_guardada);
        $stmt->fetch();

        // Verificar si la respuesta ingresada coincide con la almacenada (comparando el hash)
        if (password_verify($respuesta_usuario, $respuesta_guardada)) {
            $_SESSION['verificacion_exitosa'] = true;
            header("Location: ../html/cambiarContrasenia.html"); // Página para restablecer la contraseña
            exit();
        } else {
            header("Location: ../html/verificarRespuesta.html?error=Respuesta incorrecta");
            exit();
        }
    } else {
        header("Location: ../html/verificarRespuesta.html?error=Error al verificar");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../html/verificarRespuesta.html");
    exit();
}