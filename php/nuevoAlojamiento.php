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
    <title>Nueva propiedad</title>
    <link rel="shortcut icon" href="../images/KEYSKY.jpg" />
    <link rel="stylesheet" href="../css/nuevoAlojamiento.css">
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

    <div class="slider">
      <ul>
        <li><img src="../images/fondos/1.jpg" ></li>
        <li><img src="../images/fondos/2.jpg" ></li>
        <li><img src="../images/fondos/3.jpg" ></li>
        <li><img src="../images/fondos/6.jpg" ></li>
      </ul>
      <div class="fondo">
      </div>
    </div>

    <div class="formu">
      <h1>NUEVO ALOJAMIENTO</h1>
      <form class="formulario" id="uno" method="post" enctype="multipart/form-data">
        <label>Nombre</label>
        <input type="text" id="nom" name="nombre" placeholder="Ingresa el nombre de tu propiedad" required>
        <br/>
        <label>Ubicación</label>
        <input type="text" id="ubicacion" name="ubicacion" placeholder="¿En dónde se encuentra?" required>
        <br/>
        <label>Costo</label>
        <label> <input type="number" id="costo" name="costo" placeholder="Ingresa el costo por noche" required> MXN / noche</label>
        <br/>
        <label>Descripción</label>
        <textarea name="descripcion" id="descripcion" rows="9" cols="65" placeholder="Inserta breve descripción de tu propiedad" required></textarea>
        <br/>

        <div class="formu fotos">
          <h1>Fotos de tu alojamiento</h1>
          <label for="fot" class="archivos" id="label">Elegir archivos</label>
            <input id="fot" type="file" name="archivo[]" multiple="" required accept=" .jpg, .png, .jpeg">
            <p class="login-error">Debes subir 6 imágenes</p>
            <div class="boton">
              <button type="submit" class="publicar" id="publicar">Publicar</button>
            </div>
        </div>
      </form>
    </div>

    <!-- <div class="formu fotos">
      <h1>Fotos de tu alojamiento</h1>
      <form class="formulario" method="post">
        <input type="file" name="archivo" multiple="">
      </form>
    </div> -->

    <footer>
      <p>© 2021 KEYSKY, Inc. All rights reserved</p>
    </footer>
  </body>
  <script src="../js/nuevoAlojamiento.js"></script>
  <script src="../js/axios.min.js"></script>
</html>
