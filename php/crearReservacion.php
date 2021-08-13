<?php
  include 'connect.php';
  session_start();
  error_reporting(0);
  $varsesion = $_SESSION['Nombre'];

  if($varsesion == null || $varsesion = ''){
    echo 'Usted no tiene autorización';
    die();
  }

  $idAlojamiento = $_POST["id"];
  $fechaLlegada = $_POST["llegada"];
  $fechaSalida = $_POST["salida"];
  $nombreAlojamiento = $_POST['nombreAlojamiento'];
  $ubicacion = $_POST['ubicacion'];
  $costo = $_POST['costo'];
  $nombreAnfi = $_POST['nombreAnfi'];
  $apellidoAnfi = $_POST['apellidoAnfi'];
  $telAnfi = $_POST['telAnfi'];
  $noches = $_POST['noches'];
  $correoAnfi = $_POST['correoAnfi'];


  $consulta = "select Id_Usuario from usuarios where correo = '$_SESSION[Correo]'";
  $resultado = mysqli_query($conexion, $consulta);
  $filas = mysqli_fetch_assoc($resultado);
  $idUsuario = $filas["Id_Usuario"];

  $consulta = "insert into renta VALUES ('$idAlojamiento','$idUsuario','$fechaLlegada', '$fechaSalida')";
  mysqli_query($conexion, $consulta);

  header("Location: enviarCorreo.php?idAlojamiento=$idAlojamiento&fechaLlegada=$fechaLlegada&fechaSalida=$fechaSalida&nombreAlojamiento=$nombreAlojamiento&ubicacion=$ubicacion&costo=$costo&nombreAnfi=$nombreAnfi&apellidoAnfi=$apellidoAnfi&telAnfi=$telAnfi&noches=$noches&correoAnfi=$correoAnfi");

  ?>
