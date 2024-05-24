<?php
require_once '../funciones/conexion.php';
require_once '../controladores/controlador_ejercicio.php';

class m_gestionarEjercicios
{
  public $bd = null;

  function __construct()
  {
    $bd = conexion_BD();
  }

  public function comprobarEjercicio($id)
  {
    $bd = conexion_BD();
    $r = $bd->query("SELECT * FROM ejercicio WHERE idEjercicio = '" . $id . "'");
    if ($r->num_rows > 0) {
      $toret = true;
    } else {
      $toret = false;
    }
    return $toret;
  }

  public function getDatosEjercicio($id)
  {
    $bd = conexion_BD();
    $r = $bd->query("SELECT * FROM ejercicio WHERE idEjercicio='" . $id . "'");

    mysqli_data_seek($r, 0);
    $extraido = mysqli_fetch_array($r);
    return $extraido;
  }


  public function getDatosEjercicios()
  {
    $bd = conexion_BD();
    $sql = "SELECT * FROM ejercicio";
    $result = mysqli_query($bd, $sql);

    return $result;
  }

  public function altaEjercicio($id, $name, $des, $peso, $rep, $img, $tipo, $tiempo)
  {
    $bd = conexion_BD();

    $stmt = $bd->prepare("INSERT INTO ejercicio (idEjercicio, nombre, descripcion, peso, repeticiones, URLImagen, tipo, tiempo) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssss', $id, $name, $des, $peso, $rep, $img, $tipo, $tiempo);


    if (!$stmt->execute()) {
      echo "<script>";
      echo "alert('Error en la consulta a la base de datos');";
      echo "window.location = '../vistas/gestionarEjercicios.php'";
      echo "</script>";
    } else {
      $mensaje = "El ejercicio ha sido dado de alta en el sistema";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/gestionarEjercicios.php'";
      echo "</script>";
    }
    $stmt->close();
  }



  public function bajaEjercicio($id)
  {
    $bd = conexion_BD();
    $stmt = $bd->query("DELETE FROM ejercicio WHERE idEjercicio = '" . $id . "'");

    $r = $bd->affected_rows;
    if ($r > 0) {
      $mensaje = "El ejercicio ha sido dado de baja";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/gestionarEjercicios.php'";
      echo "</script>";
    }
    $stmt->close();
  }

  public function modificarEjercicio($id, $nombre, $descripcion, $peso, $rep, $tiempo, $imagen, $tipo)
  {
    $bd = conexion_BD();
    $stmt = $bd->query("UPDATE ejercicio SET nombre='$nombre', descripcion='$descripcion', peso='$peso', repeticiones='$rep', URLImagen='$imagen', tiempo='$tiempo',tipo='$tipo' where idEjercicio='" . $id . "' ");

    $r = $bd->affected_rows;
    if ($r > 0) {
      $mensaje = "El ejercicio ha sido modificado";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/gestionarEjercicios.php'";
      echo "</script>";
    } else {
      echo "<script>";
      echo "alert('No se ha hecho ningun cambio.');";
      echo "window.location = '../vistas/gestionarEjercicios.php'";
      echo "</script>";
    }
    $stmt->close();
  }

  public function contarEjercicio($dni, $ejercicios, $tabla)
  {
    $bd = conexion_BD();
    $ejerciciosRealizados = 0;

    if ($ejercicios !== null && is_array($ejercicios)) {
      for ($i = 0; $i < count($ejercicios); $i++) {
        $idEjer = $ejercicios[$i];

        $bd->query("INSERT INTO comenta_ejercicio VALUES ('$idEjer','','$dni',0)");
        $bd->query("UPDATE comenta_ejercicio SET contador=contador+1 WHERE Ejercicio_idEjercicio = '$idEjer' AND Usuario_DNI = '$dni' ");

        $ejerciciosRealizados++;
      }
    }

    if ($ejerciciosRealizados > 0) {
      $fecha = getdate();
      $f = $fecha['year'] . "-" . $fecha['mon'] . "-" . $fecha['mday'] . " " . $fecha['hours'] . ":" . $fecha['minutes'] . ":" . $fecha['seconds'];
      $bd->query("INSERT INTO historial VALUES ('$dni','$tabla','$f','$ejerciciosRealizados')");
    }

    $mensaje = "Ha terminado la tabla";
    echo "<script>";
    echo "alert('$mensaje');";
    echo "window.location = '../vistas/misTablas.php'";
    echo "</script>";

   
  }


  public function getVecesEjercicio($dni, $idEjer)
  {
    $bd = conexion_BD();
    $result = $bd->query("SELECT contador FROM comenta_ejercicio WHERE Ejercicio_idEjercicio = '$idEjer' AND Usuario_DNI = '$dni' ");

    $r = $bd->affected_rows;
    if ($r > 0) {
      $aux = $result->fetch_assoc();
      return $aux['contador'];
    } else {
      return 0;
    }
    
  }
}
