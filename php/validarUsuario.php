<?php
include 'connect.php';

$correo = $conexion->real_escape_string($_POST["correo"]);
$clave = $conexion->real_escape_string($_POST["clave"]);

$consulta  = "SELECT * from usuarios where correo = '$correo' and clave = '$clave'";

$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_num_rows($resultado);

if($conexion->error){
  die($conexion->error);
}

if($filas > 0) {
  echo 'Credenciales correctas';
  $consultarUsuario = "SELECT Nombre, Apellido from usuarios where correo = '$correo' and clave = '$clave'";
  $consulta = mysqli_query($conexion, $consultarUsuario);
  $fila = $consulta->fetch_assoc();
  $nombre = $fila["Nombre"];
  $apellido = $fila["Apellido"];
  session_start();
  $_SESSION['Nombre'] = $nombre;
  $_SESSION['Apellido'] = $apellido;
  $_SESSION['Correo'] = $correo;
}
else {
  http_response_code(401);
  echo 'Acceso denegado';
}

mysqli_free_result($resultado, $consulta);
mysqli_close($conexion);
