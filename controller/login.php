<?php

require 'conexion.php'; 

// Verificar si los datos fueron enviados por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener valores enviados desde el formulario
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validar que los campos no estén vacíos
    if (empty($email) || empty($password)) {
        echo "<script>alert('Por favor, complete todos los campos.');</script>";
        exit;
    }

    // Consultar si el usuario existe
    $query = "SELECT email, password FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña (usa password_verify si las contraseñas están encriptadas)
        if (password_verify($password, $user['password'])) {
            echo "<script>alert('Inicio de sesión exitoso.');</script>";
            // Redirigir o iniciar sesión
            // header('Location: dashboard.php'); // Por ejemplo, redirigir al panel
            // header('Location: indexLog.html'); // Por ejemplo, redirigir al panel
        } else {
            echo "<script>alert('Contraseña incorrecta.');</script>";
        }
    } else {
        echo "<script>alert('No se encontró una cuenta con este correo electrónico.');</script>";
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>
