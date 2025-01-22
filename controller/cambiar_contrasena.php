<?php
session_start();

// Verificar que existe un email guardado en la sesión
if (!isset($_SESSION['email_recuperacion'])) {
    header("Location: /controller/recuperar.php");
    exit();
}

$email = $_SESSION['email_recuperacion'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
</head>
<body>
    <form action="/controller/actualizar_contrasena.php" method="post" style="max-width: 400px; margin: auto;">
        <label for="nueva_password">Nueva Contraseña:</label>
        <input type="password" id="nueva_password" name="nueva_password" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc;">

        <label for="confirm_password">Confirmar Contraseña:</label>
        <input type="password" id="confirm_password" name="confirm_password" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc;">

        <button type="submit" style="background: linear-gradient(to right, #350294, #4563d9); color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; width: 100%;">Cambiar Contraseña</button>
    </form>
</body>
</html>
