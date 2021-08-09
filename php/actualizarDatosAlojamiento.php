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
  $ubicacion = $conexion->real_escape_string($_POST["ubicacion"]);
  $costo = $conexion->real_escape_string($_POST["costo"]);
  $descripcion = $conexion->real_escape_string($_POST["descripcion"]);

  // $consultarId = "Select id from usuarios where nombre = '$varsesion'";
  // $resultado = mysqli_query($conexion, $consultarId);

  $actualizar = "update alojamientos set Ubicación = '$ubicacion', Costo = '$costo', Descripción = '$descripcion' where Nombre = '$nombre'";
  $resultado = mysqli_query($conexion, $actualizar);
  // $_SESSION['Nombre'] = $nombre;
  // $_SESSION['Apellido'] = $apellido;
