<?php
include 'connect.php';

$nombre = $conexion->real_escape_string($_POST["nombre"]);
$apellido = $conexion->real_escape_string($_POST["apellido"]);
$telefono = $conexion->real_escape_string($_POST["telefono"]);
$correo = $conexion->real_escape_string($_POST["correo"]);
$contra = $conexion->real_escape_string($_POST["contra"]);

$consulta = "SELECT correo from usuarios where correo = '$correo'";

$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_num_rows($resultado);


if($conexion->error)
{
  die($conexion->error);
}

if($filas > 0) {
  http_response_code(401);
  echo 'El usuario ya existe';
}
else {
  $consulta  = "INSERT into usuarios (Nombre, Apellido, Teléfono, Correo, clave) values ('$nombre', '$apellido', '$telefono', '$correo', '$contra')";
  $resultado = mysqli_query($conexion, $consulta);
  session_start();
  $_SESSION['Nombre'] = $nombre;
  $_SESSION['Apellido'] = $apellido;
  $_SESSION['Correo'] = $correo;
}

mysqli_free_result($resultado, $consulta);
mysqli_close($conexion);
