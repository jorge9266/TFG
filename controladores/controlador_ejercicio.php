<?php

require_once '../modelos/m_gestionarEjercicios.php';

if(isset($_POST['submit'])){
  $var = $_GET['var'];

  switch ($var) {
    case 0:
      controlador_ejercicio::altaEjercicio();
      break;

      case 1:
      controlador_ejercicio::bajaEjercicio();
      break;

      case 2:
        controlador_ejercicio::modificarEjercicio();
        break;

      case 3:
        session_start();
        controlador_ejercicio::contarEjercicio();
        break;


    default:
      echo "<script>";
      echo "alert('No se reconoce la accion del metodo GET');";
      echo "window.location = '../vistas/gestionarEjercicios.php'";
      echo "</script>";
      break;
  }
}
class controlador_ejercicio
{

  public static function devolverDatosEjercicio($id)
  {

  	$m_gestionarEjercicios = new m_gestionarEjercicios();

    if($m_gestionarEjercicios->comprobarEjercicio($id))
    {
		return $m_gestionarEjercicios->getDatosEjercicio($id);
  	}else{
  		$mensaje = "El DNI introducido no corresponde a ningun ejercicio. Introduzca un DNI valido";
                  echo "<script>";
                  echo "alert('$mensaje');";
                  echo "window.location = '../vistas/gestionarEjercicios.php'";
                  echo "</script>";
  		return null;
  	}
}


public static function devolverDatosEjercicios()
  {

  	$m_gestionarEjercicios = new m_gestionarEjercicios();

		return $m_gestionarEjercicios->getDatosEjercicios();

 }

  public static function altaEjercicio()
  {
    $id = $_POST['ejercicio'];
    $name = $_POST['nombreEjercicio'];
    $des = $_POST['descripcion'];
    $peso = $_POST['peso'];
    $rep = $_POST['repeticiones'];
    $tipo = $_POST['tipo'];
    $tiempo = $_POST['tiempo'];

  
    if($_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png" || $_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/gif"){

    
               $ruta = "../images/ejercicios";
                $archivo = file_get_contents($_FILES['imagen']['tmp_name']);
                $nombreArchivo = $_FILES['imagen']['name'];
                move_uploaded_file($archivo, $ruta."/".$nombreArchivo);

      $m_gestionarEjercicios = new m_gestionarEjercicios();

        if(!$m_gestionarEjercicios->comprobarEjercicio($id))
          {
            $m_gestionarEjercicios->altaEjercicio($id, $name ,$des, $peso, $rep, $nombreArchivo, $tipo, $tiempo);
          }else {
             $mensaje = "El ID introducido tiene asociado ya un ejercicio. Revise los datos";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/gestionarEjercicios.php'";
                echo "</script>";
            }
    }else{
           $mensaje = "El Formato de imagen no es valido. Revise los datos";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/gestionarEjercicios.php'";
                echo "</script>";
          }
  }

  public static function bajaEjercicio()
  {
    $id = $_POST['idEjercicio'];
    $m_gestionarEjercicios = new m_gestionarEjercicios();
    if($m_gestionarEjercicios->comprobarEjercicio($id))
    {
      $m_gestionarEjercicios->bajaEjercicio($id);
	  $mensaje = "El ejercicio ha sido eliminado";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/gestionarEjercicios.php'";
                echo "</script>";
    }else {
      $mensaje = "El Id introducido no corresponde a ningun ejercicio, revise los datos";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/bajaEjercicio.php'";
                echo "</script>";
    }
  }

  public static function modificarEjercicio()
  {
  	$id = $_POST['actualizarid'];
  	$nombre = $_POST['actualizarnombre'];
  	$descripcion = $_POST['actualizardes'];
  	$peso = $_POST['actualizarpeso'];
    $rep = $_POST['actualizarrepeticiones'];
    $time = $_POST['actualizartiempo'];
    $tipo = $_POST['actualizartipo'];

    if($_FILES['actualizarimagen']['type']=="image/jpeg" || $_FILES['actualizarimagen']['type']=="image/png" || $_FILES['actualizarimagen']['type']=="image/jpg" || $_FILES['actualizarimagen']['type']=="image/gif"){

               $ruta = "../images/ejercicios";
                $archivo = file_get_contents($_FILES['actualizarimagen']['tmp_name']);
                $nombreArchivo = $_FILES['actualizarimagen']['name'];
                move_uploaded_file($archivo, $ruta."/".$nombreArchivo);


  	$m_gestionarEjercicios = new m_gestionarEjercicios();
    if($m_gestionarEjercicios->comprobarEjercicio($id))
    {
  	   $m_gestionarEjercicios->modificarEjercicio($id,$nombre,$descripcion,$peso, $rep, $time, $nombreArchivo, $tipo);
    }else{
      $mensaje = "El ID introducido no corresponde a ningun ejercicio. Introduzca un DNI valido";
                  echo "<script>";
                  echo "alert('$mensaje');";
                  echo "window.location = '../vistas/gestionarEjercicios.php'";
                  echo "</script>";
          }
  }else{
           $mensaje = "El Formato de imagen no es valido. Revise los datos";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/gestionarEjercicios.php'";
                echo "</script>";
      }
  }

  public static function contarEjercicio()
  {

  	$dni = $_SESSION['userID'];
    if (isset ($_POST['completados']))
      $ejercicios = $_POST['completados'];
    else {
      $ejercicios = null;
    }
    $tabla = $_GET['idTabla'];

  	$m_gestionarEjercicios = new m_gestionarEjercicios();

  	$m_gestionarEjercicios->contarEjercicio($dni,$ejercicios, $tabla);

  }

  public static function getVecesEjercicio($idEjercicio)
  {
  	$dni = $_SESSION['userID'];

    $m_gestionarEjercicios = new m_gestionarEjercicios();

  	return $m_gestionarEjercicios->getVecesEjercicio($dni,$idEjercicio);
  }
}

?>
