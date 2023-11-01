<?php

// Conexión a la base de datos 
$conexion = new mysqli("localhost", "root", "", "clinica");

if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error); 
}

// Obtiene el ID del doctor de la solicitud GET
$idDoctor = $_GET['id'];

// Consulta SQL para obtener los detalles del doctor
$sql = "SELECT idDoctor, nombreDoctor FROM doctor WHERE idDoctor = $idDoctor";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {  
  $doctor = $resultado->fetch_assoc();
  
  echo json_encode($doctor);
  
} else {
  echo json_encode(["error" => "Doctor no encontrado"]);
}

$conexion->close();

?>