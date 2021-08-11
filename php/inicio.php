<?php
  include 'connect.php';
  session_start();
  error_reporting(0);
  $varsesion = $_SESSION['Nombre'];
  $lugares = "select DISTINCT Ubicación from alojamientos";

  if($varsesion == null || $varsesion = ''){
    echo 'Usted no tiene autorización';
    die();
  }
  $fechaActual = date('Y-m-d');
  $obtenerSalidas = "Select Fecha_Salida from renta";
  $consulta = mysqli_query($conexion, $obtenerSalidas);
  while ($row = mysqli_fetch_assoc($consulta)) {
    if ($row["Fecha_Salida"] < $fechaActual){
      $fechaSalida = $row["Fecha_Salida"];
      $borrarRenta = "delete from renta where Fecha_Salida = '$fechaSalida'";
      $borrar = mysqli_query($conexion, $borrarRenta);
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../images/KEYSKY.jpg" />
    <link rel="stylesheet" href="../css/inicio.css">
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <title>Mi cuenta</title>
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
    <section>
      <div class="slider">
        <ul>
          <li><img src="../images/slider/1.jpg" alt=""></li>
          <li><img src="../images/slider/2.jpg" alt=""></li>
          <li><img src="../images/slider/3.jpg" alt=""></li>
          <li><img src="../images/slider/4.jpg" alt=""></li>
          <li><img src="../images/slider/5.jpg" alt=""></li>
          <li><img src="../images/slider/6.jpg" alt=""></li>
        </ul>
        <div class="fondo">
        </div>
        <div class="slider-text">
          <h2>Bienvenido a</h2>
          <h1>KEYSKY</h1>
        </div>
      </div>
    </section>
    <section class="busqueda">
      <img src="../images/inicio/1.jpg" alt="inicio">
      <form class="" method="post" id="buscar" action="busqueda.php">
        <h1>Busca alojamientos en KEYSKY</h1>
        <p>Descubre alojamientos enteros y habitaciones
           privadas, perfectos para cualquier viaje.</p>
           <label for="ubicacion">Ubicación</label>
             <select class="opciones lugares" name="lugar">
               <option value="">Todos los destinos</option>
               <?php $resultado =  mysqli_query($conexion, $lugares);
               while ($row = mysqli_fetch_assoc($resultado)) { ?>
                 <option value="<?php echo $row["Ubicación"]?>"><?php echo $row["Ubicación"]?></option>
               <?php }   ?>
             </select>
          <label for="llegada">Llegada</label>
          <input type="date" name="llegada" value="" class="opciones fecha" min="<?php echo date("Y-m-d");?>" id="fechaInicio" required>
          <br>
          <label for="salida">Salida</label>
          <br>
          <input type="date" name="salida" value="" class="opciones fecha" min="<?php echo date("Y-m-d");?>" id="fechaTermino" required>
          <input type="submit" name="" value="Buscar" class="submit">
      </form>
    </section>
    <footer>
      <p>
        © 2021 KEYSKY, Inc. All rights reserved
        <a href="https://github.com/eojedagalvan/KEYSKY-2.0" target="_blank"> 
          <!--<img id="logos" src="../images/acercaDe/github.png" alt="">-->
          <img id="logos" src="../images/acercaDe/git.png" alt="">
        </a>
        <a href="mailto:keyskycorporation@gmail.com?subject=Contacto - KEYSKY">
          <!--<img id="logos2" src="../images/acercaDe/correo.png" alt="">-->
          <img id="logos2" src="../images/acercaDe/correo2.png" alt="">
        </a>
      </p>
    </footer>
  </body>
  <script src="../js/validarFecha.js">
  </script>
</html>
