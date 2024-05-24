<?php

require_once '../modelos/m_gestionarTablas.php';

if (isset($_POST['submit'])) {
  $var = $_GET['var'];

  switch ($var) {
    case 0:
      controlador_tabla::crearTabla();
      break;

    case 1:
      controlador_tabla::eliminarTabla();
      break;

    case 2:
      controlador_tabla::modificarTabla();
      break;

    case 3:
      controlador_tabla::asignarDeportistaGeneral();
      break;

    case 4:
      controlador_tabla::desasignarDeportistaGeneral();
      break;





    default:
      echo "<script>";
      echo "alert('No se reconoce la accion del metodo GET');";
      echo "window.location = '../vistas/gestionarTablas.php'";
      echo "</script>";
      break;
  }
}
class controlador_tabla
{
  public static function devolverDatosTabla($id)
  {
    $m_gestionarTablas = new m_gestionarTablas();

    if ($m_gestionarTablas->comprobarTabla($id)) {
      return $m_gestionarTablas->getDatosTabla($id);
    } else {
      $mensaje = "El ID introducido no corresponde a ninguna tabla. Introduzca un ID valido";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/modificarTabla.php'";
      echo "</script>";
      return null;
    }
  }

  public static function getDeportistasAsignados($id)
  {
    $m_gestionarTablas = new m_gestionarTablas();
    return $m_gestionarTablas->getDeportistasAsignados($id);
  }

  public static function desasignarDeportistaGeneral()
  {

    $deportista = $_POST['DNI'];
    $idTabla = $_POST['idTabla'];


    $m_gestionarTablas = new m_gestionarTablas();

    $eliminarDeportistaAsignado = $m_gestionarTablas->borrarDeportistaAsignadoTabla($idTabla, $deportista);
  }



  public static function asignarDeportistaGeneral()
  {

    $deportista = $_POST['DNI'];
    $id = $_POST['idTabla'];

    $m_gestionarTablas = new m_gestionarTablas();
    if ($m_gestionarTablas->comprobarTabla($id)) {
      $m_gestionarTablas->asignarDeportistaTabla($id, $deportista);

      $mensaje = "Usuario asignado";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/asignarTabla.php?id=$id'";
      echo "</script>";
    } else {
      $mensaje = "El ID introducido no corresponde a ninguna tabla, revise los datos";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/gestionarTablas.php?id=$id'";
      echo "</script>";
    }
  }



  public static function getTablas()
  {
    $m_gestionarTablas = new m_gestionarTablas();
    return $m_gestionarTablas->getTablas();
  }

  public static function getTabla($id)
  {
    $m_gestionarTablas = new m_gestionarTablas();
    return $m_gestionarTablas->getTabla($id);
  }

  public static function devolverDatosEjercicioTabla($id)
  {
    $m_gestionarTablas = new m_gestionarTablas();
    return $m_gestionarTablas->devolverDatosEjercicioTabla($id);
  }

  public static function crearTabla()
  {
    $id = $_POST['idTabla'];
    $nombre = $_POST['nombre'];
    $ins = $_POST['instrucciones'];
    $lista = $_POST['lista'];


    $m_gestionarTablas = new m_gestionarTablas();
    if (!$m_gestionarTablas->comprobarTabla($id)) {
      $m_gestionarTablas->crearTabla($id, $nombre, $ins);
      foreach ($lista as $ejercicio) {
        $asignarEjercicioTabla = $m_gestionarTablas::tablaTieneEjercicio($ejercicio, $id);
      }
    } else {
      $mensaje = "En el sistema ya existe un tabla con ese ID. Revise los datos";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/gestionarTablas.php'";
      echo "</script>";
    }
  }

  public static function eliminarTabla()
  {
    $id = $_POST['idTabla'];

    $m_gestionarTablas = new m_gestionarTablas();
    if ($m_gestionarTablas->comprobarTabla($id)) {
      $m_gestionarTablas->eliminarTabla($id);
    } else {
      $mensaje = "El ID introducido no corresponde a ninguna Tabla, introduzca un ID valido";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/eliminarTabla.php'";
      echo "</script>";
    }
  }



  public static function modificarTabla()
  {
    $id = $_POST['actualizaridTabla'];
    $nombre = $_POST['actualizarnombreTabla'];
    $ins = $_POST['actualizarinstrucciones'];
    $lista = isset($_POST['actualizarlista']) ? $_POST['actualizarlista'] : null;

    $m_gestionarTablas = new m_gestionarTablas();
    if ($m_gestionarTablas->comprobarTabla($id)) {
      $m_gestionarTablas->modificarTabla($id, $nombre, $ins);

    
      if (is_array($lista)) {
        $m_gestionarTablas->borrarEjersTabla($id);
        foreach ($lista as $ejercicio) {
          $m_gestionarTablas->modificartablaTieneEjercicio($ejercicio, $id);
        }
      }
    } else {
      $mensaje = "El ID introducido no corresponde a ninguna tabla, revise los datos";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/modificarTabla.php'";
      echo "</script>";
    }
  }

  public static function getTablasDeportista()
  {
    $dni = $_SESSION['userID'];
    $m_gestionarTablas = new m_gestionarTablas();
    return $m_gestionarTablas->getTablasDeportista($dni);
  }
}
