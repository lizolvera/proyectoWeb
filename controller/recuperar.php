<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $respuesta_secreta = $_POST['rSecreta'];

    // Verificar la pregunta y respuesta secreta
    $query = $conn->prepare("SELECT pSecreta, rSecreta FROM usuarios WHERE correo_electronico = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $query->bind_result($pSecreta, $rSecreta);

    if ($query->fetch()) {
        // Verificar si la respuesta secreta es correcta
        if ($rSecreta === $respuesta_secreta) {
            // Respuesta correcta: redirigir al formulario de cambio de contraseña
            session_start();
            $_SESSION['email_recuperacion'] = $email; // Guardar el email para usarlo en el formulario
            header("Location: /controller/cambiar_contrasena.php");
            exit();
        } else {
            echo "La respuesta secreta es incorrecta.";
        }
    } else {
        echo "Correo electrónico no encontrado.";
    }

    $query->close();
    $conn->close();
}
?>
