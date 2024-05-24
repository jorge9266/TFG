  <?php
  require_once '../controladores/controlador_sesion.php';
  require_once '../funciones/conexion.php';

  class m_gestionarSesiones{

    public $bd = null;

    function __construct()
    {
      $bd = conexion_BD(); 
    }

	public function comprobarSesion($var)
    {
		$bd = conexion_BD();
		$r = $bd->query("SELECT * FROM sesion WHERE idSesion = '".$var."'");
		if($r->num_rows > 0){
        $toret = true;
		  }
		else {
			$toret = false;
		}
			return $toret;
	}

	public function comprobarSesionActividad($var)
    {
		$bd = conexion_BD();
		$r = $bd->query("SELECT * FROM sesion WHERE Actividad_idActividad = '".$var."'");
		if($r->num_rows > 0){
        $toret = true;
		  }
		else {
			$toret = false;
		}
			return $toret;
	}
	public function comprobarSesionesActividad($var){

		$bd = conexion_BD();
		$r = $bd->query("SELECT * FROM sesion WHERE Actividad_idActividad = '".$var."'");
		if($r->num_rows > 0){
        $toret = true;
		  }
		else {
			$toret = false;
		}
			return $toret;

	}

	public function comprobarReserva($id,$sesionID){
		$bd = conexion_BD();
		$r = $bd->query("SELECT * FROM deportista_sesion WHERE Usuario_DNI = '".$id."' && Sesion_idSesion='$sesionID'");
		if($r->num_rows > 0){
        $toret = true;
		  }
		else {
			$toret = false;
		}
			return $toret;
	}

	public function getDatosSesion($id)
	{
		$bd = conexion_BD();
		$r = $bd->query("SELECT * FROM sesion WHERE idSesion='".$id."'");

		mysqli_data_seek ($r, 0);
		$extraido= mysqli_fetch_array($r);
		return $extraido;
	}

	public function getDatosSesionesActividad($var){
		$bd = conexion_BD();
		$r = $bd->query ("SELECT * FROM sesion WHERE Actividad_idActividad='$var'");

		return $r;

	}

	public function reservaSesiones($id,$sesionID){
		$bd = conexion_BD();

    $res = $bd->query("SELECT nPlazasActual FROM sesion WHERE idSesion = '".$sesionID."' ");
    $p = $res->fetch_assoc();
    $plazas = $p['nPlazasActual'];

    if($plazas > 0)
    {
        $stmt = $bd->prepare("INSERT INTO deportista_sesion (Usuario_DNI,Sesion_idSesion) VALUES (?,?)");
        $stmt->bind_param('ss',$id, $sesionID);
        if(!$stmt->execute())
        {$mensaje = "Error en la consulta a la base de datos";
    							echo "<script>";
    							echo "alert('$mensaje');";
    							echo "window.location = '../vistas/misActividades.php'";
    							echo "</script>";


    		}
    		else
        {
          $bd->query("UPDATE sesion SET nPlazasActual=nPlazasActual-1 WHERE idSesion = '".$sesionID."'");

      		$mensaje = "Has hecho una reserva para la sesion";
      							echo "<script>";
      							echo "alert('$mensaje');";
      							echo "window.location = '../vistas/misActividades.php'";
      							echo "</script>";
    		}

        $stmt->close();
      } else {
        $mensaje = "No quedan plazas disponibles";
    							echo "<script>";
    							echo "alert('$mensaje');";
    							echo "window.location = '../vistas/misActividades.php'";
    							echo "</script>";
      }
    }

	public function cancelarReservaSesion($id,$sesionID)
    {
      $bd = conexion_BD();
      $stmt = $bd->query("DELETE FROM deportista_sesion WHERE Usuario_DNI = '".$id."' && Sesion_idSesion='$sesionID'");



	 $r=$bd->affected_rows;
      if($r>0)
      {
        $bd->query("UPDATE sesion SET nPlazasActual=nPlazasActual+1 WHERE idSesion = '".$sesionID."'");

  			$mensaje = "Ha sido cancelada tu inscripcion a la actividad";
              echo "<script>";
              echo "alert('$mensaje');";
              echo "window.location = '../vistas/misActividades.php'";
              echo "</script>";
      } else {
		  $mensaje = "No estas inscrito en la actividad";
            echo "<script>";
            echo "alert('$mensaje');";
            echo "window.location = '../vistas/misActividades.php'";
            echo "</script>";
	  }
       $stmt->close();
    }


	public function altaSesion($date, $hour,$places,$acplaces, $hombre, $activity)

    {
        $id = '0';  

        $bd = conexion_BD();
        $stmt = $bd->prepare("INSERT INTO sesion (idSesion, fecha, hora, nplazasMax, nPlazasActual, Usuario_DNI, Actividad_idActividad) VALUES (?,?, ?,?,?,?,?)");
        $stmt->bind_param('sssiisi', $id, $date, $hour, $places,$acplaces, $hombre, $activity);

        if(!$stmt->execute())
        {
          echo "zzz";

          $mensaje = "Error en la consulta a la base de datos";
    							echo "<script>";
    							echo "alert('$mensaje');";
    							echo "window.location = '../vistas/gestionarActividades.php'";
    							echo "</script>";


    		}
    		else
        {
    		$mensaje = "La sesion ha sido dado de alta en el sistema";
    							echo "<script>";
    							echo "alert('$mensaje');";
    							echo "window.location = '../vistas/gestionarActividades.php'";
    							echo "</script>";
    		}

        $stmt->close();
    }

    public function bajaSesion($id)
    {
      $bd = conexion_BD();
      $stmt = $bd->query("DELETE FROM sesion WHERE idSesion= '$id' ");

      $r=$bd->affected_rows;
      if($r>0)
      {
        $mensaje = "La sesion ha sido dado de baja";
            echo "<script>";
            echo "alert('$mensaje');";
            echo "window.location = '../vistas/gestionarActividades.php'";
            echo "</script>";
      }
      $stmt->close();
    }

	public function modificarSesion($id, $fecha, $hora, $places, $acplaces, $user, $activity)
	{
		$bd = conexion_BD();
		$stmt = $bd->query("UPDATE sesion SET fecha='$fecha', hora='$hora', nPlazasMax='$places', nPlazasActual='$acplaces', Usuario_DNI='$user', Actividad_idActividad='$activity' WHERE idSesion='".$id."' ");

    $r=$bd->affected_rows;
    if($r>0)
    {
      $mensaje = "La sesion ha sido modificada";
			echo "<script>";
			echo "alert('$mensaje');";
			echo "window.location = '../vistas/gestionarActividades.php'";
			echo "</script>";

		}else{
			$mensaje = "No se ha producido ninguna modificacion";
			echo "<script>";
			echo "alert('$mensaje');";
			echo "window.location = '../vistas/gestionarActividades.php'";
			echo "</script>";

		}
    $bd->close();
	}


	public function getMisReservas($identificacion)
	{

		$bd = conexion_BD();
		$sql = "SELECT * FROM deportista_sesion WHERE Usuario_dni='$identificacion'";
		$r = mysqli_query($bd, $sql);

			return $r;

	}

  public function devolverInscritos($sesion)
  {

    $bd = conexion_BD();
		$sql = "SELECT * FROM deportista_sesion WHERE Sesion_idSesion='$sesion'";
    $r = mysqli_query($bd, $sql);

    
    $extraido= mysqli_fetch_array($r);

    
    return $r;
  }


}

  ?>
