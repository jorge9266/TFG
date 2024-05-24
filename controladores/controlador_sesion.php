<?php

require_once '../modelos/m_gestionarSesiones.php';

if(isset($_POST['submit']))
{
  $var = $_GET['var'];

  switch ($var) {
    case 0:
      controlador_sesion::altaSesion();
      break;

    case 1:
      controlador_sesion::bajaSesion();
      break;

    case 2:
      controlador_sesion::modificarSesion();
      break;

	  case 3:
	  controlador_sesion::reservarSesion();
	  break;

	  case 4:
	  controlador_sesion::cancelarSesion();
	  break;

    default:
      echo "<script>";
      echo "alert('No se reconoce la accion del metodo GET');";
      echo "window.location = '../vistas/gestionarDeportistas.php'";
      echo "</script>";
      break;
  }
}

class controlador_sesion
{



  public static function devolverDatosSesion($id)
  {
  	$m_gestionarSesiones = new m_gestionarSesiones();

    if($m_gestionarSesiones->comprobarSesion($id))
    {
		return $m_gestionarSesiones->getDatosSesion($id);
	  }else{
		$mensaje = "Algo mal piratilla";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/gestionarSesiones.php'";
                echo "</script>";
		return null;
   }
  }

  public static function getSesionesActividad($var)
  {
  	$m_gestionarSesiones = new m_gestionarSesiones();

    if($m_gestionarSesiones->comprobarSesionActividad($var))
    {
		return $m_gestionarSesiones->getDatosSesionesActividad($var);
	  }else{
		$mensaje = "La actividad no tiene sesiones publicadas";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/misActividades.php'";
                echo "</script>";
		return null;
   }
  }

  public static function getEsto($var){

	  $m_gestionarSesiones = new m_gestionarSesiones();
	if($m_gestionarSesiones->comprobarSesionesActividad($var))
    {
		return $m_gestionarSesiones->getDatosSesionesActividad($var);
	} else {
			$mensaje = "Esta actividad no tiene sesiones";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/gestionarActividades.php'";
                echo "</script>";
		return null;
		}
  }




  public static function reservarSesion(){
	$sesionID = $_POST['sesion'];
	$id = $_POST['dniU'];

	 $m_gestionarSesiones = new m_gestionarSesiones();

	 if((!$m_gestionarSesiones->comprobarReserva($id,$sesionID))){
		  $m_gestionarSesiones->reservaSesiones($id,$sesionID);
	  }else {
		$mensaje = "Ya tienes hecha una reserva para esta sesión";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/misActividades.php'";
                echo "</script>";
	}

  }


  public static function cancelarSesion()
  {
	$sesionID = $_POST['sesion'];
	$id = $_POST['dniU'];
	$m_gestionarSesiones = new m_gestionarSesiones();
		  $m_gestionarSesiones->cancelarReservaSesion($id,$sesionID);
  }

  public static function altaSesion()
  {
    $date = $_POST['fecha'];
    $hour = $_POST['hora'];
    $places = $_POST['plazas'];
	  $acplaces =$_POST['acplazas'];
    $activity = $_POST['actividad'];
	  $monitor = $_POST['user'];

    $m_gestionarSesiones = new m_gestionarSesiones();

		  if ($acplaces > $places) {
        $mensaje = "Introduzca un numero de plazas actuales correcto";
                    echo "<script>";
                    echo "alert('$mensaje');";
                    echo "window.location = '../vistas/altaSesion.php?id=" .$activity."'";
                    echo "</script>";
		  }else{
        require_once '../modelos/m_gestionarUsuarios.php';

        $m_gestionarUsuarios = new m_gestionarUsuarios();

        $usr = $m_gestionarUsuarios->getDatosUsuario($monitor);

        if(($usr != null) && ($usr['tipo'] == "Entrenador"))
        {
          $m_gestionarSesiones->altaSesion($date, $hour,$places,$acplaces, $monitor, $activity);
        }
        else {
          $mensaje = "Introduzca un ID de entrenador correcto";
                      echo "<script>";
                      echo "alert('$mensaje');";
                      echo "window.location = '../vistas/altaSesion.php?id=" .$activity."'";
                      echo "</script>";
        }
		  }
  }

  public static function bajaSesion()
  {
    $id = $_POST['idSesion'];

    $m_gestionarSesiones = new m_gestionarSesiones();
	   if($m_gestionarSesiones->comprobarSesion($id))
    {
		    $m_gestionarSesiones->bajaSesion($id);
    }else{
    $mensaje = "El ID introducido no corresponde a ninguna sesion. Introduzca un ID valido";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/bajaSesion.php'";
                echo "</script>";
	 }
  }

  public static function modificarSesion()
  {
  	$id = $_POST['actualizaridsesion'];
  	$fecha = $_POST['actualizarfecha'];
  	$hora = $_POST['actualizarhora'];
  	$places = $_POST['actualizarplazas'];
  	$acplaces = $_POST['actualizarplazasactual'];
	$user = $_POST['actualizardni'];
    $activity = $_POST['actualizaridactividad'];


  	$m_gestionarSesiones = new m_gestionarSesiones();
    if($m_gestionarSesiones->comprobarSesion($id))
    {
  	   $m_gestionarSesiones->modificarSesion($id, $fecha, $hora, $places, $acplaces, $user, $activity);
    }else{
      $mensaje = "El ID introducido no corresponde a ninguna sesion. Introduzca un ID valido";
                  echo "<script>";
                  echo "alert('$mensaje');";
                  echo "window.location = '../vistas/modificarSesion.php'";
                  echo "</script>";
    }
  }



  public static function getMisReservas(){
	  $identificacion= $_SESSION['userID'];
	  $m_gestionarSesiones = new m_gestionarSesiones();
	   return $m_gestionarSesiones -> getMisReservas($identificacion);
  }

  public static function devolverInscritos($sesion)
  {

    $m_gestionarSesiones = new m_gestionarSesiones();

    return $m_gestionarSesiones-> devolverInscritos($sesion);
  }



}

?>
