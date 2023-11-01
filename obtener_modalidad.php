<?php

// Conexión a la base de datos 
$conexion = new mysqli("localhost", "root", "", "clinica");

if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error); 
}

// Obtiene el ID del doctor de la solicitud GET
$idModalidad = $_GET['id'];

// Consulta SQL para obtener los detalles del doctor
$sql = "SELECT idModalidad, nombreModalidad FROM modalidad WHERE idModalidad = $idModalidad";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {  
  $Modalidad = $resultado->fetch_assoc();
  
  echo json_encode($Modalidad);
  
} else {
  echo json_encode(["error" => "Modalidad no encontrada"]);
}

$conexion->close();

?>