<?php
session_start(); // Inicia la sesión

require 'conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        echo "<script>alert('Por favor, complete todos los campos.');</script>";
        exit;
    }

    $query = "SELECT id, username, password FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Almacenar datos del usuario en la sesión
            $_SESSION['username'] = $user['username'];
            $_SESSION['id'] = $user['id'];

            echo "<script>alert('Inicio de sesión exitoso.');</script>";
            header("Location: /proyectoWeb/html/indexLog.php");
            exit();
        } else {
            echo "<script>alert('Contraseña incorrecta.');</script>";
        }
    } else {
        echo "<script>alert('No se encontró una cuenta con este correo electrónico.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
