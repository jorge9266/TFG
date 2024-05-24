  <?php

  require_once '../funciones/conexion.php';

  class m_gestionarUsuarios
  {

    public $bd = null;

    function __construct()
    {
      $bd = conexion_BD();
    }

    public function comprobarUsuario($identificacion)
    {
      $bd = conexion_BD();
      $r = $bd->query("SELECT * FROM usuario WHERE DNI = '" . $identificacion . "'");
      if ($r->num_rows > 0) {
        $toret = true;
      } else {
        $toret = false;
      }
      return $toret;
    }

    public function comprobarUsuarioLogin($id, $pass, $tipe)
    {
      $bd = conexion_BD();
      $r = $bd->query("SELECT * FROM usuario WHERE DNI = '" . $id . "' AND password='" . $pass . "' AND tipo ='" . $tipe . "' ");

      if ($r->num_rows > 0) {
        $toret = true;
        mysqli_data_seek($r, 0);
        $extraido = mysqli_fetch_array($r);


        $usuarioID = $extraido['ID'];

        session_start();
        $_SESSION['ID'] = $usuarioID;

        $d = $extraido['tipo'];

        if ($d == 'Entrenador') {
          $mensaje = "Sesión Iniciada";
          echo "<script>";
          echo "alert('$mensaje');";
          echo "window.location = '../vistas/entrenador.php'";
          echo "</script>";
        } else if ($d == 'Deportista') {
          $mensaje = "Sesión Iniciada";
          echo "<script>";
          echo "alert('$mensaje');";
          echo "window.location = '../vistas/deportista.php'";
          echo "</script>";
        } else if ($d == 'Administrador') {
          $mensaje = "Sesión Iniciada";
          echo "<script>";
          echo "alert('$mensaje');";
          echo "window.location = '../vistas/administrador.php'";
          echo "</script>";
        }
      } else {
        $toret = false;
        $mensaje = "Fallo al iniciar sesión, compruebe sus datos e inténtelo de nuevo";
        echo "<script>";
        echo "alert('$mensaje');";
        echo "window.location = '../vistas/principal.php'";
        echo "</script>";
      }
      $bd->close();


      return $usuarioID;
    }


    public function getUsuarios()
    {
      $bd = conexion_BD();
      $sql = "SELECT * FROM usuario";
      $result = mysqli_query($bd, $sql);

      return $result;
    }

    public function getDeportistas()
    {
      $bd = conexion_BD();
      $sql = "SELECT * FROM usuario where tipo='Deportista' ";
      $result = mysqli_query($bd, $sql);

      return $result;
    }

    public function getEntrenadores()
    {
      $bd = conexion_BD();
      $sql = "SELECT * FROM usuario where tipo='Entrenador' ";
      $result = mysqli_query($bd, $sql);
      return $result;
    }


    public function getDeportistasGeneral()
    {
      $idEntrenador = $_SESSION['ID'];
      $bd = conexion_BD();


      $sql = "SELECT * FROM usuario u INNER JOIN usuario_entrenadores ue ON ue.id_usuario = u.ID WHERE ue.id_entrenador = ? AND u.tipo = 'Deportista'";


      $stmt = $bd->prepare($sql);

      if (!$stmt) {

        return false;
      }


      $stmt->bind_param('i', $idEntrenador);


      $stmt->execute();


      $result = $stmt->get_result();


      return $result;
    }






    public function getDatosUsuario($dni)
    {
      $bd = conexion_BD();
      $r = $bd->query("SELECT * FROM usuario WHERE DNI='" . $dni . "'");

      mysqli_data_seek($r, 0);
      $extraido = mysqli_fetch_array($r);
      return $extraido;
    }

    public function getEntrenadorUser($dni)
    {
      $bd = conexion_BD();
      $query = "SELECT e.nombre 
                  FROM usuario u 
                  JOIN entrenadores e ON u.entrenador = e.dni 
                  WHERE u.DNI = '$dni' AND u.tipo = 'Deportista'";
      $result = mysqli_query($bd, $query);

      if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['nombre'];
      } else {
        return null;
      }
    }


    public function getHistorialDeportistas($dni)
    {
      $bd = conexion_BD();
      $extraido = $bd->query("SELECT * FROM historial WHERE Usuario_DNI='" . $dni . "' ORDER BY FECHA ASC");

      $r = $bd->affected_rows;
      if ($r > 0) {

        return $extraido;
      } else {
        $mensaje = "Su historial esta vacio.";
        echo "<script>";
        echo "alert('$mensaje');";
        echo "window.location = '../vistas/deportista.php'";
        echo "</script>";

        return null;
      }
      $bd->close();
    }

    public function   eliminarHistorialDeportista($dniDeportista)
    {
      $bd = conexion_BD();
      $extraido = $bd->query("DELETE FROM historial WHERE Usuario_DNI='" . $dniDeportista . "'");

      $r = $bd->affected_rows;
      if ($r > 0) {
        $mensaje = "Historial eliminado.";
        echo "<script>";
        echo "alert('$mensaje');";
        echo "window.location = '../vistas/deportista.php'";
        echo "</script>";
      } else {
        $mensaje = "Su historial esta vacio.";
        echo "<script>";
        echo "alert('$mensaje');";
        echo "window.location = '../vistas/deportista.php'";
        echo "</script>";
      }
      $bd->close();
    }

    public function altaUsuario($identificacion, $nombre, $pass, $correo, $surname, $tipe)
    {
      try {


        $bd = conexion_BD();

        $stmt = $bd->prepare("INSERT INTO usuario (dni, nombre, apellidos, email, password, tipo) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssss', $identificacion, $nombre, $surname, $correo, $pass, $tipe);

        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
      } catch (Exception $e) {
        echo "Error: " . $e;
        return $e;
      }
    }



    public function bajaUsuario($identificacion)
    {
      $bd = conexion_BD();
      $stmt = $bd->query("DELETE FROM usuario WHERE DNI = '$identificacion' ");

      if ($stmt === false) {
        $error = $bd->error;
        $mensaje = "Error al dar de baja al usuario: $error";
        echo "<script>";
        echo "alert('$mensaje');";
        echo "window.location = '../vistas/gestionarUsuarios.php'";
        echo "</script>";
      } else {
        $r = $bd->affected_rows;
        if ($r > 0) {
          $mensaje = "Usuario dado de baja";
          echo "<script>";
          echo "alert('$mensaje');";
          echo "window.location = '../vistas/gestionarUsuarios.php'";
          echo "</script>";
        }
        $stmt->close();
      }
    }



    public function modificarUsuario($nombre, $pass, $correo, $identificacion, $surname, $tipe)
    {
      $bd = conexion_BD();
      $stmt = $bd->prepare("UPDATE usuario SET nombre=?, apellidos=?, email=?, password=?, tipo=?  WHERE DNI=?");
      $stmt->bind_param("ssssss", $nombre, $surname, $correo, $pass, $tipe, $identificacion);
      $stmt->execute();

      $r = $stmt->affected_rows;
      $stmt->close();

      if ($r > 0) {
        $mensaje = "Cambios realizados";
      } else {
        $mensaje = "Error al realizar los cambios.";
      }


      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/gestionarUsuarios.php'";
      echo "</script>";
    }



    public function modificarPerfil($nombre, $pass, $correo, $identificacion, $surname, $tipe)
    {
      $bd = conexion_BD();
      $stmt = $bd->query("UPDATE usuario SET nombre='$nombre', apellidos='$surname', email='$correo', password='$pass', tipo='$tipe' where DNI='" . $identificacion . "' ");

      $r = $bd->affected_rows;
      if ($r > 0) {
        $mensaje = "Cambios realizados";
        echo "<script>";
        echo "alert('$mensaje');";
        echo "window.location = '../vistas/verPerfil.php'";
        echo "</script>";
      } else {
        echo "<script>";
        echo "alert('Error al realizar los cambios.');";
        echo "window.location = '../vistas/verPerfil.php'";
        echo "</script>";
      }
      $stmt->close();
    }

    public static function añadirComentarioEjercicio($comentario, $idEjercicio, $idUsuario, $idTabla)
    {
      $bd = conexion_BD();
      $stmt = $bd->prepare("UPDATE comenta_ejercicio SET comentario=? WHERE Usuario_ID=? AND Ejercicio_idEjercicio=?");
      $stmt->bind_param('sii', $comentario, $idUsuario, $idEjercicio);
      $stmt->execute();

      $r = $stmt->affected_rows;
      $stmt->close();

      if ($r > 0) {
        $mensaje = "Comentario Realizado";
        echo "<script>";
        echo "alert('$mensaje');";
        echo "window.location = '../vistas/verTablaDeportista.php?id=$idTabla'";
        echo "</script>";
      } else {
        echo "<script>";
        echo "alert('Error al realizar los cambios.');";
        echo "window.location = '../vistas/verTablaDeportista.php?id=$idTabla'";
        echo "</script>";
      }
    }


    public static function getComentarios($idEjercicio, $ID)
    {
      $ID = $_SESSION['ID'];
      $bd = conexion_BD();
      $sql =  "SELECT comentario FROM comenta_ejercicio where Usuario_ID='" . $ID . "' AND Ejercicio_idEjercicio='" . $idEjercicio . "'";
      $result = mysqli_query($bd, $sql);

      return $result;
    }

    public static function relacionDeportistaEntrenador($idEnt, $idDep)
    {
      $bd = conexion_BD();

      if ($bd->connect_error) {
        die("Connection failed: " . $bd->connect_error);
      }

      $stmt = $bd->prepare("INSERT INTO usuario_entrenadores (id_usuario, id_entrenador) VALUES (?, ?)");
      if (!$stmt) {
        die("Prepare failed: " . $bd->error);
      }

      $stmt->bind_param('ii', $idDep, $idEnt);
      $resultado = $stmt->execute();

      if (!$resultado) {
        die("Execute failed: " . $stmt->error);
      }

      $stmt->close();
      $bd->close();

      $mensaje = "Relación creada correctamente";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/gestionarUsuarios.php'";
      echo "</script>";

      return true;
    }
  }

  ?>
