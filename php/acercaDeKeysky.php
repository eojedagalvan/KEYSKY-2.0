<?php
  include 'connect.php';
  session_start();
  error_reporting(0);
  $varsesion = $_SESSION['Nombre'];

  if($varsesion == null || $varsesion = ''){
    echo 'Usted no tiene autorización';
    die();
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Acerca de KEYSKY</title>
    <link rel="shortcut icon" href="../images/KEYSKY.jpg" />
    <link rel="stylesheet" href="../css/acercaDeKeysky.css">
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

    <section class="inicio">
      <img id="uno" src="../images/acercaDe/one.jpg" width="1059" height="603">
      <h1 id="text" >KEYSKY</h1>
    </section>

    <section class="who">
      <img id="dos" src="../images/acercaDe/two.jpg">
      <h1 id="tit1">¿Quiénes somos?</h1>
      <p id="somos">
        Somos una compañía dedicada a la oferta de distintos alojamientos
        en donde nuestros usuarios pueden publicar sus propiedades al igual
        que rentar de los demás usuarios.
        <br/> <br/> <br/>
        En <span id="name">KEYSKY </span>estamos comprometidos en brindar un servicio exclusivo
        a nuestros usuarios para que puedan gozar de los inmuebles
        publicados en nuestra plataforma.
      </p>
    </section>

    <section class="frase">
      <h2>« Invertir en viajar, es invertir en uno mismo » <br/><br/>
      - Matthew Karsten</h2>
    </section>

    <section class="contactos">
      <img id="tres" src="../images/acercaDe/who.jpg">
      <h1 id="fund">Fundación</h1>
      <p id="nosotros">
        <span id="name">KEYSKY </span>surge de la idea de <span>Eduardo Ojeda</span>
        y <span>Karen Núñez</span>,
        dos estudiantes de la carrera de Ingeniería de Software de
        la Universidad Autónoma de Guadalajara,
        por desarrollar una plataforma en la cual los usuarios
        pudieran ofrecer distintos
        alojamientos para rentar o publicar uno propio.
        <br/><br/><br/>
        El desarrollo de proyecto comenzó en el mes de Enero del año 2021 y culmina en
        Abril del mismo año, dejando en funcionamiento la plataforma para futuros usuarios.
      </p>
    </section>

    <!-- <section class="divisor">
      <img id="cuatro" src="../images/acercaDe/three.jpg" width="1326" height="700">
      <p class="texto">Collect moments, not things.</p>
    </section> -->

    <section class="final">
      <h1 id="tfinal">Contáctanos</h1>
      <ul>
        <li id="con">Eduardo Ojeda</li>
        <p id="correo1">Correo: ojedaeduardo2001@gmail.com</p>
        <li id="con">Karen Núñez</li>
        <p id="correo2">Correo: karennunez580@gmail.com</p>
        <li id="con">KEYSKY</li>
        <p id="correo3"><a href="https://github.com/eojedagalvan/KEYSKY" target="_blank">GitHub: KEYSKY</a></p>
      </ul>
    </section>

    <footer>
      <p>© 2021 KEYSKY, Inc. All rights reserved</p>
    </footer>
  </body>
</html>
