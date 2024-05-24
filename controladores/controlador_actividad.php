<?php

require_once '../modelos/m_gestionarActividades.php';

if(isset($_POST['submit'])){
$var = $_GET['var'];

switch ($var) {
  case 0:
    controlador_actividad::publicarActividad();
    break;

  case 1:
    controlador_actividad::cancelarActividad();
    break;

  case 2:
   controlador_actividad::modificarActividad();
   break;


  default:
    echo "<script>";
    echo "alert('No se reconoce la accion del metodo GET');";
    echo "window.location = '../vistas/gestionarActividades.php'";
    echo "</script>";
    break;
}
}
class controlador_actividad
{

  public static function devolverActividad($id)
  {

    $m_gestionarActividades = new m_gestionarActividades();

    if($m_gestionarActividades->comprobarActividad($id))
    {
    return $m_gestionarActividades->getDatosActividad($id);
    }else{
    $mensaje = "El ID introducido no corresponde a ninguna actividad. Introduzca un ID valido";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/gestionarActividades.php'";
                echo "</script>";
    return null;
   }
  }


  public static function devolverDatosActividad()
  {
    $id = $_POST['idActividad'];

    $m_gestionarActividades = new m_gestionarActividades();

    if($m_gestionarActividades->comprobarActividad($id))
    {
    return $m_gestionarActividades->getDatosActividad($id);
    }else{
    $mensaje = "El ID introducido no corresponde a ninguna actividad. Introduzca un ID valido";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/gestionarActividades.php'";
                echo "</script>";
    return null;
   }
 }

  public static function getActividades(){
    $m_gestionarActividades = new m_gestionarActividades();
    return $m_gestionarActividades->getActividades();
  }

  public static function publicarActividad()
  {

    $name = $_POST['nombreA'];
    $tipe = $_POST['tipo'];
    $des = $_POST['descripcion'];
    $place = $_POST['lugar'];

    $m_gestionarActividades = new m_gestionarActividades();


      $m_gestionarActividades->publicarActividad($name,$tipe, $des, $place);

  }

  public static function cancelarActividad()
  {
    $id = $_POST['idActividad'];
    $m_gestionarActividades = new m_gestionarActividades();
	if($m_gestionarActividades->comprobarActividad($id))
    {
    $m_gestionarActividades->cancelarActividad($id);
    $mensaje = "La Actividad ha sido eliminada";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/gestionarActividades.php'";
                echo "</script>";

	} else {
				$mensaje = "El id introducido no corresponde a ninguna Actividad, Introduzca un id valido";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/gestionarActividad.php'";
                echo "</script>";
      }
  }

  public static function modificarActividad()
    {
      $id = $_POST['actualizarid'];
      $nombre = $_POST['actualizarnombre'];
      $tipo = $_POST['actualizartipo'];
      $des = $_POST['actualizardescrip'];
      $lugar = $_POST['actualizarlugar'];

      $m_gestionarActividades = new m_gestionarActividades();
      if($m_gestionarActividades->comprobarActividad($id))
      {
         $m_gestionarActividades->modificarActividad($id,$nombre,$tipo,$des,$lugar);
      }else{
        $mensaje = "El ID introducido no corresponde a ninguna Actividad, Introduzca un id valido";
                    echo "<script>";
                    echo "alert('$mensaje');";
                    echo "window.location = '../vistas/gestionarActividades.php'";
                    echo "</script>";
      }
    }

}

?>
