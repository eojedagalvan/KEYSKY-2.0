<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['Nombre'];

if($varsesion != null){
  header("Location: ./php/inicio.php");
  die();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/master.css" />
    <link rel="shortcut icon" href="images/KEYSKY.jpg" />
    <title>KEYSKY</title>
  </head>
  <body>
    <div class="login-box">
      <img class="avatar" src="images/KEYSKY 4.jpg" alt="Logo" />
      <h1>Iniciar sesión</h1>

      <form id="login-form" action="php/validarUsuario.php" method="post">
        <label for="e-mail">Correo</label>
        <input
          type="email"
          id="correo"
          name="correo"
          placeholder="Ingresa tu correo"
          required
        />

        <p class="login-error hide"></p>

        <label for="password">Contraseña</label>
        <input
          type="password"
          id="clave"
          name="clave"
          placeholder="Ingresa tu contraseña"
          required
        />
        <input type="submit" value="Ingresar" />
      </form>
      <a href="html/registrarUsuarios.html">Aún no tienes cuenta?</a>
      <a href="#">Recuperar Contraseña</a>
    </div>
  </body>
</html>
<script src="js/validar.js"></script>
<script src="js/axios.min.js"></script>
