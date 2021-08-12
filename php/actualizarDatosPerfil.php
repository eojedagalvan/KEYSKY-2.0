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

  $consultarId = "Select Id_Usuario from usuarios where Correo = '$correo'";
  $resultado = mysqli_query($conexion, $consultarId);
  $id = mysqli_fetch_assoc($resultado);
  $idUsuario = $id['Id_Usuario'];


  $actualizar = "update usuarios set Nombre = '$nombre', Apellido = '$apellido', Teléfono = '$tel', Correo = '$correo', clave = '$clave' where correo = '$correo'";
  $resultado = mysqli_query($conexion, $actualizar);
  $_SESSION['Nombre'] = $nombre;
  $_SESSION['Apellido'] = $apellido;

  if(isset($_FILES['foto'])){
    $path = "../images/miPerfil/$idUsuario";
    $nombre_base = $idUsuario . '.jpg';
    mkdir($path);
    $query = "update usuarios set picture_pic = '$path/$nombre_base' where Correo = '$correo'";
    $resultado = mysqli_query($conexion, $query);
  
    $ruta = "$path/" . $nombre_base;
    $subirarchivo = move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);

  }

