<?php
  include 'connect.php';
  session_start();
  error_reporting(0);
  $varsesion = $_SESSION['Nombre'];

  if($varsesion == null || $varsesion = ''){
    echo 'Usted no tiene autorización';
    die();
  }
  $id= $_GET['Id'];
  $consulta ="Select * from alojamientos where Id_Alojamiento = '$id'";
  $resultado = mysqli_query($conexion, $consulta);
  $alojamiento = mysqli_fetch_assoc($resultado);
  $checarfotos = "select * from imagen where Id_Alojamiento = '$id'";
  $resultado = mysqli_query($conexion, $checarfotos);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $alojamiento["Nombre"] ?></title>
    <link rel="shortcut icon" href="../images/KEYSKY.jpg" />
    <link rel="stylesheet" href="../css/detallesAlojamientoDueño.css">
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
      <h1>Tu alojamiento</h1>
      <div class="informacion">
        <form class="" method="post" id="form-modificar">
        <div class="campo">
          <label for="nombre">Nombre: </label>
          <input class="campos" type="text" name="nombre" id="nombre" value="<?php echo $alojamiento["Nombre"] ?>" required disabled>
        </div>
        <br>
        <div class="campo">
          <label for="ubicacion">Ubicación: </label>
          <input class="campos" type="text" name="ubicacion" id="ubicacion" value="<?php echo $alojamiento["Ubicación"] ?>" required disabled>
        </div>
        <br>
        <div class="campo">
          <label for="costo">Costo por noche: </label>
          <input class="campos" type="text" name="costo" id="costo" value="<?php echo $alojamiento["Costo"] ?>" required disabled>
        </div>
        <br>
        <div class="campo">
          <label for="descripcion">Descripción: </label>
            <textarea class="campos" name="descripcion" id="descripcion" rows="9" cols="65" disabled><?php echo $alojamiento["Descripción"] ?></textarea>
        </div>
        <p class="error hide"></p>
        <div class="boton">
          <button type="click" name="button" class="" id="modificar">Modificar informacion</button>
        </div>
        <button type="submit" name="button" class="boton1 hide" id="confirmar">Guardar cambios</button>
        <button type="click" name="button" class="boton1 hide" id="cancelar">Cancelar</button>
      </form>
    </div>
    <div class="info">
    <div class="fotos">
      <h1>Fotos de tu alojamiento</h1>
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
      <div class="">
        <button type="button" name="button" class="submit">Subir nuevas fotos</button>
      </div>
    </div>
    <input type="text" name="" value="<?php echo $id ?>" class="hide" id="id">
    <input type="button" name="" value="Eliminar alojamiento" class="eliminar" id="eliminar">
  </div>
    </section>
  </body>
  <script src="../js/axios.min.js"></script>
  <script src="../js/eliminarAlojamiento.js"></script>
  <script src="../js/sliderManual.js"></script>
  <script src="../js/validarAlojamiento.js"></script>
</html>
