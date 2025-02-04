<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../html/verificarCorreo.html?error=Correo Invalido");
        exit();
    }
    
    // Consultar si el correo existe en la base de datos
    $stmt = $conn->prepare("SELECT id, pSecreta FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $pSecreta);
        $stmt->fetch();
        $_SESSION['email_recuperacion'] = $email;

        // Pasamos la pregunta secreta en la URL
        header("Location: ../html/verificarRespuesta.html?pSecreta=" . urlencode($pSecreta));
        exit();
    } else {
        header("Location: ../html/verificarCorreo.html?error=Correo no registrado");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../html/verificarCorreo.html");
    exit();
}
