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

  $IdUsuario = "SELECT Id_Usuario from usuarios where correo = '$_SESSION[Correo]'";
  $resultadoUsuario = mysqli_query($conexion, $IdUsuario);
  $id = mysqli_fetch_assoc($resultadoUsuario);

  //Insertar en la tabla de alojamientos
  $insertar =  "INSERT into alojamientos (Nombre, Ubicación, Costo, Descripción, Id_Usuario) values ('$nombre', '$ubicacion', '$costo', '$descripcion','$id[Id_Usuario]')";
  $resultado = mysqli_query($conexion, $insertar);

  //Insertar en tabla dueños
  $consulta = "SELECT Id_Usuario from duenos where Id_Usuario = '$id[Id_Usuario]'";
  $resultadoId = mysqli_query($conexion, $consulta);
  $filas = mysqli_num_rows($resultadoId);
  if($filas == 0) {
    $insertarDueno  = "INSERT into duenos (Id_Usuario) values ('$id[Id_Usuario]')";
    $resultadodueno = mysqli_query($conexion, $insertarDueno);
  }


  //Insertar en tabla imagenes
  $idAlojamiento = "Select Id_Alojamiento from alojamientos where Id_Usuario = '$id[Id_Usuario]' order by Id_Alojamiento DESC";
  $resultadoAl = mysqli_query($conexion, $idAlojamiento);
  $idAl = mysqli_fetch_assoc($resultadoAl);
  $idAlojamiento = $idAl["Id_Alojamiento"];
  //Subir imagenes a su correspondiente carpeta
  $path = "../images/alojamientos/$nombre";
  mkdir($path);

  for ($i=0; $i < 6; $i++) {
  $nombre_base = $i+1 . '.jpg';
  $consulta = "insert into imagen (Id_Alojamiento, imagen) VALUES ('$idAlojamiento', '$nombre_base')";
  $resultado = mysqli_query($conexion, $consulta);
  $ruta = "$path/" . $nombre_base;
  $subirarchivo = move_uploaded_file($_FILES["fotos" . $i]["tmp_name"], $ruta);
}


  mysqli_free_result($resultado);
  mysqli_free_result($resultadodueno);
  mysqli_free_result($insertar);
  mysqli_close($conexion);
  // mysqli_free_result($resultadoImagenes);
  // mysqli_free_result($insertarImagenes);
?>
