<?php
  include 'connect.php';
  session_start();
  error_reporting(0);
  $varsesion = $_SESSION['Nombre'];
  if($varsesion == null || $varsesion = ''){
    echo 'Usted no tiene autorización';
    die();
  }
  $nombre = $conexion->real_escape_string($_POST["nombre"]);
  $apellido = $conexion->real_escape_string($_POST["apellido"]);
  $correo = $conexion->real_escape_string($_POST["correo"]);
  $clave = $conexion->real_escape_string($_POST["clave"]);
  $tel = $conexion->real_escape_string($_POST["tel"]);

  $consultarId = "Select id from usuarios where nombre = '$varsesion'";
  $resultado = mysqli_query($conexion, $consultarId);
  $id =

  $actualizar = "update usuarios set Nombre = '$nombre', Apellido = '$apellido', Teléfono = '$tel', Correo = '$correo', clave = '$clave' where correo = '$correo'";
  $resultado = mysqli_query($conexion, $actualizar);
  $_SESSION['Nombre'] = $nombre;
  $_SESSION['Apellido'] = $apellido;
