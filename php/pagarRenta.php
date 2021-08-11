<?php
  include 'connect.php';
  session_start();
  error_reporting(0);
  $varsesion = $_SESSION['Nombre'];

  if($varsesion == null || $varsesion = ''){
    echo 'Usted no tiene autorización';
    die();
  }

$idAlojamiento = $_GET['id'];
$fechaLlegada = $_GET['llegada'];
$fechaSalida = $_GET['salida'];
  ?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Procesar pago</title>
      <link rel="shortcut icon" href="../images/KEYSKY.jpg" />
      <link rel="stylesheet" href="../css/pagarRenta.css">
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
        <h1>Completa tus datos</h1>
        <div class="formulario">
          <form class="" action="crearReservacion.php" method="post">
            <input type="text" name="id" value="<?php echo $idAlojamiento ?>" style="display:none;">
            <input type="text" name="llegada" value="<?php echo $fechaLlegada ?>" style="display:none;">
            <input type="text" name="salida" value="<?php echo $fechaSalida ?>" style="display:none;">
            <div class="seccion">
            <div class="datosPersonales">
              <label for="nombre">Nombre: </label>
              <input type="text" name="nombre" value="" placeholder="Como aparece en la tarjeta" id="nombre" required>
              <label for="apelllido">Apellido: </label>
              <input type="text" name="apellido" value="" placeholder="Como aparece en la tarjeta" id="apellido" required>
              <label for="email">Correo: </label>
              <input type="email" name="email" value="" placeholder="Ingresa tu correo" id="correo" required>
            </div>
          </div>
          <div class="seccion">
            <div class="tarjeta">
              <label for="numTarjeta">Número de tarjeta: </label>
              <input type="text" name="numTarjeta" value="" placeholder="    -  -  -  -  -  " id="numTarjeta" maxlength="16" required>
              <label for="CCV">CCV</label>
              <input type="password" name="CCV" value="" placeholder="3 dígitos de seguridad" id="ccv" maxlength="3" required>
              <label for="fecha">Fecha de expiración: </label>
              <input type="date" name="" value="" id="expiracion" required min="<?= date('Y-m-d') ?>">
            </div>
          </div>
          <div class="submit">
            <button type="submit" name="button">Procesar pago</button>
          </div>
          </form>
        </div>
        <div class="mensaje">
          <h1>¡Estás a un paso de vivir una experiencia inolvidable!</h1>
        </div>
      </section>
      <script src="../js/pagarRenta.js"></script>
    </body>
</html>
