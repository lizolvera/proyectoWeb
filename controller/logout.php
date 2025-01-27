<?php
session_start(); // Inicia la sesión

// Elimina todas las variables de sesión
$_SESSION = [];

// Destruye la sesión
session_destroy();

// Redirige al usuario a la página de inicio
header("Location: /proyectoWeb/");
exit();
?>
