<?php

// Conexión a la base de datos 
$conexion = new mysqli("localhost", "root", "", "clinica");

if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error); 
}

// Obtiene el ID del doctor de la solicitud GET
$id = $_GET['id'];

// Consulta SQL para obtener los detalles del doctor
$sql = "SELECT id, nombrePaciente, correoPaciente, telefonoPaciente, fechaCita, horaCita, nombreEspecialidad, nombreDoctor, nombreModalidad, mensaje FROM citas WHERE id = $id";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {  
  $citas = $resultado->fetch_assoc();
  
  echo json_encode($citas);
  
} else {
  echo json_encode(["error" => "Cita no encontrada"]);
}

$conexion->close();

?>