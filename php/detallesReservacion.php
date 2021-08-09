<?php
  include 'connect.php';
  session_start();
  error_reporting(0);
  $varsesion = $_SESSION['Nombre'];

  if($varsesion == null || $varsesion = ''){
    echo 'Usted no tiene autorización';
    die();
  }
  date_default_timezone_set('America/Mexico_City');
  $id= $_GET['id'];
  $fechaSalida= $_GET['out'];
  $fechaLlegada= $_GET['in'];
  $consulta ="Select * from alojamientos where Id_Alojamiento = $id";
  $resultado = mysqli_query($conexion, $consulta);
  $alojamiento = mysqli_fetch_assoc($resultado);
  $checarfotos = "select * from imagen where Id_Alojamiento = '$id'";
  $resultado = mysqli_query($conexion, $checarfotos);
  $dueño = "Select * from usuarios where Id_Usuario = '$alojamiento[Id_Usuario]'";
  $resultados = mysqli_query($conexion, $dueño);
  $anfitrion = mysqli_fetch_assoc($resultados);
  $Llegada  = new DateTime($fechaLlegada);
  $Salida = new DateTime($fechaSalida);
  $intvl = $Llegada->diff($Salida);
  $Noches =  $intvl->days;
  $Total = $Noches*$alojamiento["Costo"];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $alojamiento["Nombre"] ?></title>
    <link rel="shortcut icon" href="../images/KEYSKY.jpg" />
    <link rel="stylesheet" href="../css/detallesReservacion.css">
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
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
      <h1><?php echo $alojamiento["Nombre"] ?></h1>
      <h4><?php echo $alojamiento["Ubicación"] ?></h4>
      <article class="container-slider">
        <div class="slider" id="slider">
        <?php while ($fotos = mysqli_fetch_assoc($resultado)) { ?>
          <div class="slider_section">
          <img src="../images/alojamientos/<?php echo $alojamiento["Nombre"] ?>/<?php echo $fotos["Imagen"] ?>" alt="" class="slider-img">
        </div>
      <?php } ?>
      </div>
      <div class="slider-btn slider-btn-right" id="btn-right">></div>
      <div class="slider-btn slider-btn-left" id="btn-left"><</div>
      </article>
      <article class="informacion">
        <div class="descripcion">
          <h2>Acerca de la <?php echo $alojamiento["Nombre"]?></h2>
          <p><?php echo $alojamiento["Descripción"] ?></p>
          <div class="anfitrion">
            <div class="datos">
            <h2>¿Tienes dudas?</h2>
          <h2>Contacta al Anfitrión: </h2>
          <h3>Nombre: </h3>
            <p><?php echo $anfitrion["Nombre"]; echo " " ;echo $anfitrion["Apellido"]; ?></p>
            <br>
            <h3>Correo: </h3>
            <p><?php echo $anfitrion["Correo"] ?></p>
            <br>
            <h3>Tel: </h3>
            <p><?php echo $anfitrion["Teléfono"] ?></p>
            <br>
          </div>
          <div class="imagen">
            <img src="../images/KEYSKY 2.jpg" alt="">
          </div>
        </div>
        <div class="frase">
          <h1>¡Prepárate para vivir inolvidables recuerdos!</h1>
        </div>
        </div>
        <div class="resumen">
          <form class="" action="index.html" method="post">
            <h3>Resumen de tu reservación</h3>
            <br>
            <div class="nombreAlojamiento">
            <p><?php echo $alojamiento["Nombre"] ?></p>
            </div>
            <br>
            <div class="info">
              <h4>Ubicación:</h4>
              <p><?php echo $alojamiento["Ubicación"] ?></p>
            </div>
            <br>
            <div class="info">
              <h4>Fecha de llegada: </h4>
              <p><?php echo $fechaLlegada ?></p>
            </div>
            <br>
            <div class="info">
              <h4>Fecha de Salida: </h4>
              <p><?php echo $fechaSalida ?></p>
            </div>
            <br>
            <div class="info">
              <h4>TOTAL: </h4>
              <p>$<?php echo $Total ?> / MXN</p>
            </div>
          </form>
        </div>
        <input type="text" id="llegada" style="display:none;" value="<?php echo $fechaLlegada ?>">
        <input type="text" name=""  id="Id_Alojamiento" style="display:none;" value="<?php echo $id ?>">
        <div class="cancelar">
          <input type="button" name="" value="Cancelar reservación" class="submit">
        </div>
    </article>
    </section>
  </body>
  <script src="../js/slider.js"></script>
  <script src="../js/axios.min.js"></script>
  <script src="../js/cancelarReservacion.js"></script>
</html>
