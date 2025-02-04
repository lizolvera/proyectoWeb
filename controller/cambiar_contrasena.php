<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (!isset($_SESSION['email_recuperacion'])) {
        echo json_encode(["success" => false, "message" => "Sesión expirada."]);
        exit();
    }

    $email = $_SESSION['email_recuperacion'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if ($password !== $confirm_password) {
        echo json_encode(["success" => false, "message" => "Las contraseñas no coinciden."]);
        exit();
    }

    // Encriptar la contraseña antes de almacenarla
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("UPDATE usuarios SET PASSWORD = ? WHERE email = ?");
    $stmt->bind_param("ss", $password_hash, $email);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Contraseña actualizada correctamente."]);
        session_destroy(); // Eliminar la sesión después de cambiar la contraseña
    } else {
        echo json_encode(["success" => false, "message" => "Error al actualizar la contraseña."]);
    }

    $stmt->close();
    $conn->close();
}
?>
