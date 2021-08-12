<?php
  include 'connect.php';
  session_start();
  error_reporting(0);
  $varsesion = $_SESSION['Nombre'];
  $consultar = "Select * from usuarios where correo = '$_SESSION[Correo]'";
  $resultado =  mysqli_query($conexion, $consultar);
  $fila = mysqli_fetch_assoc($resultado);
  $nombre = $fila['Nombre'];
  $apellido = $fila['Apellido'];
  $correo = $fila['Correo'];
  $clave = $fila['clave'];
  $tel = $fila['Teléfono'];
  $path = $fila['picture_pic'];

  if($path == ''){
    $path = '../images/miPerfil/perfil.png';
  }

  if($varsesion == null || $varsesion = ''){
    echo 'Usted no tiene autorización';
    die();
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mi perfil</title>
    <link rel="shortcut icon" href="../images/KEYSKY.jpg" />
    <link rel="stylesheet" href="../css/miPerfil.css">
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
    <section class="datos">
      
      <div class="imagenes">
        <img src="<?= $path ?>" alt="" id="imagenDefault">
        <label for="fot" class="fot" id="label">
          <img src="../images/miPerfil/cam.png" alt="" class="camara hide" id="camara">
        </label>
        <input id="fot" type="file" name="archivo" hidden class="hide" accept=" .jpg, .png, .jpeg">
      </div>

        <fieldset>
          <legend>Mis datos personales</legend>
          <form class=""  method="post" id="form-modificar">
          <label for="nombre">Nombre: </label>
          <input type="text" name="nombre" class="campo" id="nombre" value="<?php echo $_SESSION['Nombre'] ?>" required disabled>
          <label for="apellido">Apellido: </label>
          <input type="text" name="apellido" class="campo" id="apellido" value="<?php echo $_SESSION['Apellido'] ?>" required disabled>
          <label for="correo">Correo: </label>
          <input type="email" name="correo" class="campo" id="correo" value="<?php echo $correo ?>" required disabled>
          <label for="clave">Contraseña: </label>
          <input type="password" name="password" class="campo" id="clave" value="<?php echo $clave ?>" required disabled>
          <label for="tel">Teléfono: </label>
          <input type="tel" name="telefono" class="campo" id="tel" value="<?php echo $tel ?>" required disabled>
          <p class="error hide"></p>
          <button type="click" name="button" class="boton" id="modificar">Modificar datos</button>
          <button type="submit" name="button" class="boton izquierda hide" id="confirmar">Guardar cambios</button>
          <button type="click" name="button" class="boton  izquierda cancelar hide" id="cancelar">Cancelar</button>
        </form>
        </fieldset>
    </section>
  </body>
  <script src="../js/validarInfo.js"></script>
  <script src="../js/axios.min.js"></script>
</html>
