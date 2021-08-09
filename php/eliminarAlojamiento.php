<?php
  include 'connect.php';
$Id_Alojamiento = $conexion->real_escape_string($_POST["id"]);

$consulta = "Select * from alojamientos where Id_Alojamiento = '$Id_Alojamiento'";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_num_rows($resultado);
$alojamiento = mysqli_fetch_assoc($resultado);

if ($filas < 1){
  echo "No se encontró el alojamiento";
  http_response_code(404);
} else {
  $consulta = "delete from imagen where Id_Alojamiento = '$Id_Alojamiento'";
  $resultado = mysqli_query($conexion, $consulta);
  $consulta = "delete from alojamientos where Id_Alojamiento = '$Id_Alojamiento'";
  $resultado = mysqli_query($conexion, $consulta);
  $consulta = "Select * from alojamientos where Id_Usuario = '$alojamiento[Id_Usuario]'";
  $resultado = mysqli_query($conexion, $consulta);
  $filas = mysqli_num_rows($resultado);

  if ($filas < 1) {
    $consulta = "Delete from duenos where Id_Usuario = '$alojamiento[Id_Usuario]'";
    $resultado = mysqli_query($conexion, $consulta);
  }
}
