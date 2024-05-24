<?php
  require_once '../controladores/controlador_tabla.php';
  require_once '../funciones/conexion.php';

  class m_gestionarTablas{

    public $bd = null;

    function __construct()
    {
      $bd = conexion_BD();
    }


	public function comprobarTabla($id)
    {
		$bd = conexion_BD();
    $r = $bd->query("SELECT * FROM tabla WHERE idTabla = '".$id."'");
    if($r->num_rows > 0){
      $toret = true;
    }
    else {
      $toret = false;
    }
    return $toret;
  }

  public function getDatosTabla($id)
	{
		$bd = conexion_BD();
		$r = $bd->query("SELECT * FROM tabla WHERE idTabla='".$id."'");

		mysqli_data_seek ($r, 0);
		$extraido= mysqli_fetch_array($r);
		return $extraido;
	}

	  public function getTablas()
    {
      $bd = conexion_BD();
      $sql = "SELECT * FROM tabla";
      $result = mysqli_query($bd, $sql);

      return $result;
    }

    public function getTabla($id)
    {
      $bd = conexion_BD();
      $sql = "SELECT * FROM tabla where idTabla='".$id."'";
      $result = mysqli_query($bd, $sql);

      return $result;
    }

    public function getTablasDeportista($dni)
    {
	$bd = conexion_BD();
      $sql = "SELECT * FROM deportista_tiene_tabla WHERE Usuario_dni='$dni'";
      $r = mysqli_query($bd, $sql);

		  return $r;
			
   
    }

    public function devolverDatosEjercicioTabla($id){
      $bd = conexion_BD();
      $sql= "SELECT * FROM ejercicio E, tabla_tiene_ejercicio T WHERE T.Tabla_idTabla='".$id."'  AND E.idEjercicio = T.Ejercicio_idEjercicio";
      $result = mysqli_query($bd, $sql);

      return $result;
    }

		public function crearTabla($id, $nombre, $ins)
    {

        $bd = conexion_BD();
        $stmt = $bd->prepare("INSERT INTO tabla (idTabla, nombre,instrucciones) VALUES ( ?, ?, ?)");
        $stmt->bind_param('sss', $id, $nombre, $ins);

        if(!$stmt->execute())
        {

    		}
    		else
        {

    		$mensaje = "La tabla ha sido creada";
    							echo "<script>";
    							echo "alert('$mensaje');";
    							echo "window.location = '../vistas/gestionarTablas.php'";
    							echo "</script>";
    		}

            $stmt->close();
    }

	  public function eliminarTabla($id)
    {
      $bd = conexion_BD();
      $stmt=$bd->query("DELETE FROM tabla_tiene_ejercicio WHERE Tabla_idTabla ='$id' ");

      $stmt=$bd->query("DELETE FROM deportista_tiene_tabla WHERE Tabla_idTabla ='$id' ");

      $stmt = $bd->query("DELETE FROM tabla WHERE idTabla= '$id' ");

      $r=$bd->affected_rows;
      if($r>0)
      {
        $mensaje = "La tabla ha sido eliminada";
            echo "<script>";
            echo "alert('$mensaje');";
            echo "window.location = '../vistas/gestionarTablas.php'";
            echo "</script>";
      }
      $stmt->close();
    }

    public function borrarEjersTabla($id){
        $bd = conexion_BD();
        $stmt=$bd->query("DELETE FROM tabla_tiene_ejercicio WHERE Tabla_idTabla ='".$id."' ");

    }

    public function getDeportistasAsignados($id){
      $bd = conexion_BD();
      $sql = "SELECT * FROM usuario U, deportista_tiene_tabla T WHERE T.Tabla_idTabla='".$id."'  AND U.DNI = T.Usuario_DNI";
      $result = mysqli_query($bd, $sql);

      return $result;

    }

  public function tablaTieneEjercicio($idEjercicio, $id){
       $bd = conexion_BD();
        $stmt = $bd->prepare("INSERT INTO tabla_tiene_ejercicio (Ejercicio_idEjercicio, Tabla_idTabla) VALUES ( ?, ?)");
        $stmt->bind_param('ss', $idEjercicio, $id);

        if(!$stmt->execute())
        {

        }
        else
        {

        $mensaje = "La tabla ha sido creada";
                  echo "<script>";
                  echo "alert('$mensaje');";
                  echo "window.location = '../vistas/gestionarTablas.php'";
                  echo "</script>";
        }

            $stmt->close();

  }

  public function asignarDeportistaTabla($id, $dni){
       $bd = conexion_BD();
        $stmt = $bd->prepare("INSERT INTO deportista_tiene_tabla (Tabla_idTabla, Usuario_DNI) VALUES ( ?, ?)");
        $stmt->bind_param('ss', $id, $dni);

        if(!$stmt->execute())
        {

        }

            $stmt->close();

  }

  public function borrarDeportistaAsignadoTabla($id, $dni){
        $bd = conexion_BD();
        $stmt=$bd->query("DELETE FROM deportista_tiene_tabla WHERE Tabla_idTabla ='".$id."' AND  Usuario_DNI ='".$dni."'");



        $mensaje = "Usuario ya no esta asignado";
                  echo "<script>";
                  echo "alert('$mensaje');";
                  echo "window.location = '../vistas/asignarTabla.php?id=$id'";
                  echo "</script>";

            $stmt->close();

  }

  public function modificartablaTieneEjercicio($idEjercicio, $id){

      $bd = conexion_BD();
        $stmt = $bd->prepare("INSERT INTO tabla_tiene_ejercicio (Ejercicio_idEjercicio, Tabla_idTabla) VALUES ( ?, ?)");
        $stmt->bind_param('ss', $idEjercicio, $id);

         if(!$stmt->execute())
        {
          $mensaje = "La tabla no tiene ejercicios";
          echo "<script>";
          echo "alert('$mensaje');";
          echo "window.location = '../vistas/verTabla.php?id=$id'";
          echo "</script>";
        }
        else
        {

        $mensaje = "La tabla ha sido modificada";
                  echo "<script>";
                  echo "alert('$mensaje');";
                  echo "window.location = '../vistas/verTabla.php?id=$id'";
                  echo "</script>";
        }

        $stmt->close();

  }

	public function modificarTabla($id,$nombre,$ins)
	{
		$bd = conexion_BD();
		$stmt = $bd->query("UPDATE tabla SET nombre='$nombre', instrucciones='$ins'  where idTabla='".$id."' ");


	}
  }
  ?>
