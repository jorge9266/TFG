 <?php
  require_once '../controladores/controlador_inscripcion.php';
  require_once '../funciones/conexion.php';

  class m_gestionarInscripciones{

    public $bd = null;

    function __construct()
    {
      $bd = conexion_BD(); 
    }

	public function comprobarDeportistaActividad($identificacion, $activity)
    {
      $bd = conexion_BD();
      $r = $bd->query("SELECT * FROM deportista_hace_actividad WHERE Usuario_dni = '".$identificacion."' && Actividad_idActividad= '$activity' ");
  		if($r->num_rows > 0){
        $toret = true;
		  }
      else {
        $toret = false;
      }
      return $toret;
	}


	public function inscripcionActividad($identificacion, $activity)
    {

        $bd = conexion_BD();
        $stmt = $bd->prepare("INSERT INTO deportista_hace_actividad (Actividad_idActividad, Usuario_dni) VALUES ( ?, ?)");
        $stmt->bind_param('ss',$activity, $identificacion );

        if(!$stmt->execute())
        {

    		}
    		else
        {

    		$mensaje = "Has sido inscrito en la actividad";
    							echo "<script>";
    							echo "alert('$mensaje');";
    							echo "window.location = '../vistas/gestionarActividades.php'";
    							echo "</script>";
    		}

            $stmt->close();
    }

	public function cancelarInscripcion ($identificacion, $activity)
    {
      $bd = conexion_BD();
      $stmt = $bd->query("DELETE FROM deportista_hace_actividad WHERE Usuario_DNI= '$identificacion' && Actividad_idActividad='$activity'");

      $r=$bd->affected_rows;
      if($r>0)
      {
			$mensaje = "Ha sido cancelada tu inscripcion a la actividad";
            echo "<script>";
            echo "alert('$mensaje');";
            echo "window.location = '../vistas/gestionarActividades.php'";
            echo "</script>";
      } else {
		  $mensaje = "No estas inscrito en la actividad";
            echo "<script>";
            echo "alert('$mensaje');";
            echo "window.location = '../vistas/gestionarActividades.php'";
            echo "</script>";
	  }
       $stmt->close();
    }

	public function getMisActividades($identificacion)
	{

		$bd = conexion_BD();
		$sql = "SELECT * FROM deportista_hace_actividad WHERE Usuario_dni='$identificacion'";
		$r = mysqli_query($bd, $sql);

			return $r;

	}

  public function devolverInscritos($actividad)
  {

    $bd = conexion_BD();
		$sql = "SELECT * FROM deportista_hace_actividad WHERE Actividad_idActividad='$actividad'";
    $r = mysqli_query($bd, $sql);

   
    $extraido= mysqli_fetch_array($r);

  
    return $r;
  }

  }
