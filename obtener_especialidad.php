<?php

// Conexión a la base de datos 
$conexion = new mysqli("localhost", "root", "", "clinica");

if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error); 
}

// Obtiene el ID de la Especialidad de la solicitud GET
$idEspecialidad = $_GET['id'];

// Consulta SQL para obtener los detalles de la Especialidad
$sql = "SELECT idEspecialidad, nombreEspecialidad FROM especialidad WHERE idEspecialidad = $idEspecialidad";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {  
  $Especialidad = $resultado->fetch_assoc();
  
  echo json_encode($Especialidad);
  
} else {
  echo json_encode(["error" => "Especialidad no encontrada"]);
}

$conexion->close();

?>