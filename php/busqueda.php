<?php
  include 'connect.php';
  session_start();
  error_reporting(0);
  $varsesion = $_SESSION['Nombre'];

  if($varsesion == null || $varsesion = ''){
    echo 'Usted no tiene autorización';
    die();
  }
  $nombre = $_SESSION['Nombre'];
  $idUsuario = "Select Id_Usuario from usuarios where Nombre = '$nombre'";
  $resultado = mysqli_query($conexion, $idUsuario);
  $id = mysqli_fetch_assoc($resultado);
  $idUsuario = $id["Id_Usuario"];
  $lugar = $_POST['lugar'];
  $fechaLlegada = $_POST['llegada'];
  $fechaSalida = $_POST['salida'];

  function check_in_range($fecha_inicio, $fecha_fin, $fecha){

     $fecha_inicio = strtotime($fecha_inicio);
     $fecha_fin = strtotime($fecha_fin);
     $fecha = strtotime($fecha);

     if(($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {
         return true;
     } else {
         return false;
     }
 }
  if($lugar == ""){
    $consulta = "Select * from alojamientos where Id_Usuario <> '$idUsuario'";
  } else {
    $consulta = "Select * from alojamientos where Ubicación = '$lugar' and Id_Usuario <> '$idUsuario'";
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../images/KEYSKY.jpg" />
    <link rel="stylesheet" href="../css/busqueda.css">
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <title>Búsqueda</title>
  </head>
  <body>
    <header>
        <input type="checkbox" id="btn-menu" value="">
        <label for="btn-menu" class="icono-menu"><i class="fas fa-bars"></i></label>
        <nav class="menu">
          <img src="../images/KEYSKY 4.jpg" alt="logo">
        <ul>
          <li><a href="inicio.php">Inicio</a></li>
          <li><a href="misReservaciones.php">Mis reservaciones</a></li>
          <li><a href="acercaDeKeysky.php">Acerca de KEYSKY</a></li>
          <li class="drop"><a><?php echo $nombre ; echo " " ;echo $_SESSION['Apellido']?></a>
            <ul>
              <li><a href="miPerfil.php">Mi perfil</a></li>
              <li><a href="misAlojamientos.php">Mis alojamientos</a></li>
              <li><a href="cerrarSesion.php">Cerrar sesión</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>
    <section id="primeraSeccion">
      <h1>Resultado de estancias <?php echo $lugar ?></h1>
      <?php $resultado = mysqli_query($conexion, $consulta);
      while ($row = mysqli_fetch_assoc($resultado)) {
          $idAlojamiento = $row["Id_Alojamiento"];
          $consultarDispo = "Select * from renta where Id_Alojamiento = '$idAlojamiento'";
          $checarRenta = mysqli_query($conexion, $consultarDispo);
          $filas = mysqli_num_rows($checarRenta);

          if($filas > 0){
            while($resultados = mysqli_fetch_assoc($checarRenta)){
              if (check_in_range($fechaLlegada,$fechaSalida, $resultados["Fecha_Entrada"])){
                continue 2;
              } else if (check_in_range($fechaLlegada,$fechaSalida, $resultados["Fecha_Salida"])){
                continue 2;
              } else if (check_in_range($resultados["Fecha_Entrada"],$resultados["Fecha_Salida"], $fechaLlegada)){
                continue 2;
              } else if (check_in_range($resultados["Fecha_Entrada"],$resultados["Fecha_Salida"], $fechaSalida)){
                continue 2;
              }
            }
          }?>
          <a href="detallesAlojamiento.php?Id=<?php echo $idAlojamiento?>&In=<?php echo $fechaLlegada ?>&Out=<?php echo $fechaSalida ?>">
            <section class="alojamiento">
            <img src="../images/alojamientos/<?php echo $row["Nombre"]; ?>/1.jpg" alt="">
            <article class="info">
              <h5><?php echo $row["Ubicación"] ?></h5>
              <h2><?php echo $row["Nombre"] ?></h2>
              <p><?php echo $row["Descripción"] ?></p>
              <h3>$<?php echo $row["Costo"] ?> MXN / noche</h3>
            </article>
          </section>
        </a>
        <?php } ?>
    </section>
  </body>
</html>
