<?php
  @session_start();


 require_once '../funciones/conexion.php';


require_once '../modelos/m_gestionarInscripciones.php';
require_once '../funciones/sesion.php';

if(isset($_POST['submit'])){
  $var = $_GET['var'];

  switch ($var) {
    case 0:
      controlador_inscripcion::inscripcionActividad();
      break;

    case 1:
      controlador_inscripcion::cancelarInscripcion();
      break;
	  default:
      echo "<script>";
      echo "alert('No se reconoce la accion del metodo GET');";
      echo "window.location = '../vistas/gestionarUsuarios.php'";
      echo "</script>";
      break;
  }
}

class controlador_inscripcion
{
	public static function inscripcionActividad()
  {
    $identificacion = $_POST['dniU'];
    $activity = $_POST['actividad'];
	$name = $_POST['nombreActividad'];

	$m_gestionarInscripciones = new m_gestionarInscripciones();
    if(!$m_gestionarInscripciones->comprobarDeportistaActividad($identificacion, $activity))
	{

	$m_gestionarInscripciones-> inscripcionActividad($identificacion,$activity);
	} else {
		$mensaje = "Ya estas inscrito en esta actividad, no puedes volver a inscribirte";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/gestionarActividades.php'";
                echo "</script>";
	}
  }

	public static function cancelarInscripcion()
  {
    $identificacion = $_POST['dniU'];
    $activity = $_POST['actividad'];

    $m_gestionarInscripciones = new m_gestionarInscripciones();
	$m_gestionarInscripciones -> cancelarInscripcion($identificacion, $activity);

  }

  public static function getMisActividades(){
	  $identificacion= $_SESSION['userID'];
	  $m_gestionarInscripciones = new m_gestionarInscripciones();
	   return $m_gestionarInscripciones -> getMisActividades($identificacion);
  }


  public static function devolverInscritos($activity)
  {

    $m_gestionarInscripciones = new m_gestionarInscripciones();

    return $m_gestionarInscripciones-> devolverInscritos($activity); 
  }
}


?>
