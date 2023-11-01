<?php
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "clinica");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtén los datos del formulario
$nombre = $_POST['nombre'];
$contrasena = $_POST['contrasena'];

// Consulta para verificar las credenciales del usuario
$query = "SELECT id, rol FROM usuarios WHERE nombre = '$nombre' AND contrasena = '$contrasena'";
$resultado = $conexion->query($query);

if ($resultado->num_rows == 1) {
    $fila = $resultado->fetch_assoc();
    
    // Establece una variable de sesión para almacenar el rol del usuario
    $_SESSION['rol'] = $fila['rol'];

    if ($_SESSION['rol'] == 'usuario') {
        // Usuario autenticado, redirige a la vista de usuario
        // header("Location: vista_usuario.php");
        header("Location: index.html");
    } elseif ($_SESSION['rol'] == 'admin') {
        // Administrador autenticado, redirige a la vista de administrador
        header("Location: index_admin.php");
    }
} else {
    // Usuario no autenticado, redirige al formulario de inicio de sesión
    header("Location: login.html");
}

$conexion->close();
?>
