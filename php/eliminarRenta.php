<?php
include 'connect.php';

$Id_Alojamiento = $conexion->real_escape_string($_POST["Id_Alojamiento"]);
$llegada = $conexion->real_escape_string($_POST["Llegada"]);

$consulta = "Select * from renta where Id_Alojamiento = '$Id_Alojamiento' and Fecha_Entrada = '$llegada'";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_num_rows($resultado);

if ($filas > 0){
  $renta = mysqli_fetch_assoc($resultado);
  $consultas = "delete from renta where Id_Alojamiento = '$Id_Alojamiento' and Fecha_Entrada = '$llegada'";
  $resultados = mysqli_query($conexion,$consultas);
} else {
  http_response_code(404);
}
 ?>
