<?php
function conexion_BD ()
{
  $mysqli = new mysqli("localhost", "root", "", "gym");
  if ($mysqli->connect_errno) {
      echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  else

  return $mysqli;
}
?>
