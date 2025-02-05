<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../html/verificarCorreo.html?error=Correo Invalido");
        exit();
    }

    // Array de preguntas secretas
    $preguntas = [
        "personaje-favorito" => "¿Cuál es tu personaje favorito?",
        "pelicula-favorita" => "¿Cuál es tu película favorita?",
        "mejor-amigo" => "¿Quién es tu mejor amigo?",
        "nombre-mascota" => "¿Cuál es el nombre de tu mascota?",
        "deporte-favorito" => "¿Cuál es tu deporte favorito?"
    ];
    
    $stmt = $conn->prepare("SELECT id, pSecreta FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $pregunta_guardada);
        $stmt->fetch();
        $_SESSION['email_recuperacion'] = $email;

        // Verificar si la pregunta secreta está en el array
        $pregunta_mostrada = isset($preguntas[$pregunta_guardada]) ? $preguntas[$pregunta_guardada] : "Pregunta no encontrada";

        // Redirigir a la siguiente página con la pregunta secreta como parámetro
        header("Location: ../html/verificarRespuesta.html?pSecreta=" . urlencode($pregunta_mostrada));
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
