<?php
session_start();

echo "vista de admin";
// Verifica si el usuario tiene permisos de administrador
if ($_SESSION['rol'] !== 'admin') {
    // Redirige a una página de acceso denegado o a la página de inicio de usuario
    header("Location: acceso_denegado.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido</title>
</head>
<body>
    <h2>Bienvenido, usuario admin autenticado</h2>
    <a href="cerrar_sesion.php">Cerrar sesión</a>
</body>
</html>
