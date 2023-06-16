<?php
$conexion = mysqli_connect("srv760.hstgr.io", "u630097666_keysky", "Keysky58", "u630097666_keysky");
mysqli_set_charset($conexion, "utf8");
if (!$conexion) {
  echo 'Error al conectar a la base de datos';
}
// else {
//   echo 'Conectado a la base de datos';
// }
