<?php
  include 'connect.php';
  session_start();
  error_reporting(0);
  $varsesion = $_SESSION['Nombre'];

  if($varsesion == null || $varsesion = ''){
    echo 'Usted no tiene autorización';
    die();
  }

  $idUsuario = "Select Id_Usuario from usuarios where Correo = '$_SESSION[Correo]'";
  $consulta = mysqli_query($conexion, $idUsuario);
  $id = mysqli_fetch_assoc($consulta);
  $checarRenta = "Select * from renta where Id_Usuario = '$id[Id_Usuario]'";
  $consulta = mysqli_query($conexion, $checarRenta);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../images/KEYSKY.jpg" />
    <link rel="stylesheet" href="../css/misReservaciones.css">
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <title>Mis reservaciones</title>
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
          <li class="drop"><a><?php echo $_SESSION['Nombre'] ; echo " " ;echo $_SESSION['Apellido']?></a>
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
      <?php if(mysqli_num_rows($consulta) > 0){
        while ($hayRenta = mysqli_fetch_assoc($consulta)) {
          $realizarConsulta = "Select * from alojamientos where Id_Alojamiento = '$hayRenta[Id_Alojamiento]'";
          $resultado = mysqli_query($conexion, $realizarConsulta);
          $alojamiento = mysqli_fetch_assoc($resultado);
          $nombreAlojamiento = $alojamiento["Nombre"];?>
          <div class="alojamiento">
            <div class="imagen">
              <img src="..\images\alojamientos\<?php  echo $nombreAlojamiento?>\1.jpg" alt="">
            </div>
            <h2><?php echo $alojamiento["Nombre"] ?></h2>
          <a href="detallesReservacion.php?id=<?php echo $alojamiento["Id_Alojamiento"] ?>&in=<?php echo $hayRenta["Fecha_Entrada"] ?>&out= <?php echo $hayRenta["Fecha_Salida"] ?>"><button type="button" name="button">Detalles</button></a>  
          </div>

    <?php  }
     }
      else { ?>
        <div class="noRentas">
            <h1>No tienes reservaciones activas</h1>
            <h3>¡Descubre todos los lugares que tenemos para ti!</h3>
            <a href="inicio.php"><button type="button" name="button"> + Hacer una reservación</button></a>
        </div>
    <?php }?>
    </section>
  </body>
</html>
