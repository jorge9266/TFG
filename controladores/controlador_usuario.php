<?php

require_once '../modelos/m_gestionarUsuarios.php';
require_once '../funciones/sesion.php';

if (isset($_POST['submit'])) {
  $var = $_GET['var'];

  switch ($var) {
    case 0:
      controlador_usuario::altaUsuario();
      break;

    case 1:
      controlador_usuario::bajaUsuario();
      break;

    case 2:
      controlador_usuario::modificarUsuario();
      break;

    case 3:
      controlador_usuario::loginUsuario();
      break;

    case 4:
      controlador_usuario::logOutUsuario();
      break;

    case 5:
      controlador_usuario::modificarPerfil();
      break;

    case 6:
      controlador_usuario::eliminarHistorialDeportista();
      break;

    case 7:
      controlador_usuario::añadirComentarioEjercicio();
      break;

    case 8:
      $idEnt = $_POST['entrenador'];
      $idDep = $_POST['deportista'];
      controlador_usuario::relacionDeportistaEntrenador($idEnt, $idDep);
      break;


    default:
      echo "<script>";
      echo "alert('No se reconoce la accion del metodo GET');";
      echo "window.location = '../vistas/gestionarUsuarios.php'";
      echo "</script>";
      break;
  }
}

class controlador_usuario
{

  public static function loginUsuario()
  {
    $id = $_POST['dni'];
    $pass = $_POST['contrasena'];
    $tipe = $_POST['tipo'];



    $m_gestionarUsuarios = new m_gestionarUsuarios();

    if ($m_gestionarUsuarios->comprobarUsuarioLogin($id, $pass, $tipe)) {
      iniciarSesion($id, $tipe);
    } else {
      $mensaje = "Error en los datos";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/gestionarUsuarios.php'";
      echo "</script>";
    }
  }

  public static function logOutUsuario()
  {
    cerrarSesion();
    $mensaje = "Error en los datos";
    echo "<script>";
    echo "alert('$mensaje');";
    echo "window.location = '../vistas/principal.php'";
    echo "</script>";
  }

  public static function devolverUsuario($dni)
  {

    $m_gestionarUsuarios = new m_gestionarUsuarios();

    if ($m_gestionarUsuarios->comprobarUsuario($dni)) {
      return $m_gestionarUsuarios->getDatosUsuario($dni);
    } else {
      $mensaje = "El DNI introducido no corresponde a ningun usuario/Deportista /n Introduzca un DNI valido";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/gestionarUsuarios.php'";
      echo "</script>";
      return null;
    }
  }

  public static function getUsuarios()
  {
    $m_gestionarUsuarios = new m_gestionarUsuarios();
    return $m_gestionarUsuarios->getUsuarios();
  }

  public static function getEntrenadores()
  {
    $m_gestionarUsuarios = new m_gestionarUsuarios();
    return $m_gestionarUsuarios->getEntrenadores();
  }

  public static function getEntrenadorUsuario($dni)
  {
    $m_gestionarUsuarios = new m_gestionarUsuarios();
    return $m_gestionarUsuarios->getEntrenadorUser($dni);
  }


  public static function getDeportistas()
  {
    $m_gestionarUsuarios = new m_gestionarUsuarios();
    return $m_gestionarUsuarios->getDeportistas();
  }

  public static function getDeportistasGeneral()
  {
    $m_gestionarUsuarios = new m_gestionarUsuarios();
    return $m_gestionarUsuarios->getDeportistasGeneral();
  }


  public static function getHistorialDeportistas()
  {


    $dniUsuario = $_SESSION['userID'];
    $m_gestionarUsuarios = new m_gestionarUsuarios();
    return $m_gestionarUsuarios->getHistorialDeportistas($dniUsuario);
  }

  public static function altaUsuario()
  {
    $identificacion = $_POST['dni'];
    $nombre = $_POST['usuario'];
    $pass = $_POST['contrasena'];
    $correo = $_POST['email'];
    $surname = $_POST['apellidos'];
    $tipe = $_POST['tipo'];


    $m_gestionarUsuarios = new m_gestionarUsuarios();

    if (!$m_gestionarUsuarios->comprobarUsuario($identificacion)) {

      $resultado = $m_gestionarUsuarios->altaUsuario($identificacion, $nombre, $pass, $correo, $surname, $tipe);

      if ($resultado) {
        $mensaje = "Usuario dado de alta";
      } else {
        $mensaje = "Error al dar de alta el usuario";
      }

      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/gestionarUsuarios.php'";
      echo "</script>";
    } else {
      $mensaje = "El usuario con el DNI introducido ya está dado de alta en el sistema. Revise los datos.";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/gestionarUsuarios.php'";
      echo "</script>";
    }
  }



  public static function guardarEntrenador($dni, $nombre)
  {
    $bd = conexion_BD();
    $sql = "INSERT INTO Entrenadores (dni, nombre) VALUES (?, ?)";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("ss", $dni, $nombre);
    $stmt->execute();
    $stmt->close();
  }



  public static function bajaUsuario()
  {
    $identificacion = $_POST['dni'];

    $m_gestionarUsuarios = new m_gestionarUsuarios();
    if ($m_gestionarUsuarios->comprobarUsuario($identificacion)) {
      $m_gestionarUsuarios->bajaUsuario($identificacion);
    } else {
      $mensaje = "El DNI introducido no corresponde a ningun usuario/Deportista /n Introduzca un DNI valido";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/gestionarUsuarios.php'";
      echo "</script>";
    }
  }

  public static function getEntrenadorId($nombreEntrenador)
  {
    $bd = conexion_BD();
    $sql = "SELECT dni FROM Entrenadores WHERE nombre = ?";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("s", $nombreEntrenador);
    $stmt->execute();
    $stmt->bind_result($dni);
    $stmt->fetch();
    $stmt->close();
    return $dni;
  }


  public static function modificarUsuario()
  {
    $nombre = $_POST['actualizarnombre'];
    $pass = $_POST['actualizarpass'];
    $email = $_POST['actualizaremail'];
    $dni = $_POST['actualizardni'];
    $apellidos = $_POST['actualizarapellidos'];
    $tipe = $_POST['actualizartipo'];


    $m_gestionarUsuarios = new m_gestionarUsuarios();
    if ($m_gestionarUsuarios->comprobarUsuario($dni)) {
      $m_gestionarUsuarios->modificarUsuario($nombre, $pass, $email, $dni, $apellidos, $tipe);
    } else {
      $mensaje = "El DNI introducido no corresponde a ningún usuario/deportista. Introduzca un DNI válido";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/gestionarUsuarios.php'";
      echo "</script>";
    }
  }



  public static function modificarPerfil()
  {
    $nombre = $_POST['actualizarnombre'];
    $pass = $_POST['actualizarpass'];
    $email = $_POST['actualizaremail'];
    $dni = $_POST['actualizardni'];
    $apellidos = $_POST['actualizarapellidos'];
    $tipe = $_POST['actualizartipo'];




    $m_gestionarUsuarios = new m_gestionarUsuarios();
    if ($m_gestionarUsuarios->comprobarUsuario($dni)) {
      $m_gestionarUsuarios->modificarPerfil($nombre, $pass, $email, $dni, $apellidos, $tipe);
    } else {
      $mensaje = "El DNI introducido no corresponde a ningun usuario/Deportista /n Introduzca un DNI valido";
      echo "<script>";
      echo "alert('$mensaje');";
      echo "window.location = '../vistas/verPerfil.php'";
      echo "</script>";
    }
  }

  public static function eliminarHistorialDeportista()
  {
    session_start();

    $dniDeportista = $_SESSION['userID'];

    $m_gestionarUsuarios = new m_gestionarUsuarios();
    return $m_gestionarUsuarios->eliminarHistorialDeportista($dniDeportista);
  }

  public static function añadirComentarioEjercicio()
  {
    $idTabla = $_POST['idTabla'];
    $idEjercicio = $_POST['idEjercicio'];
    $idUsuario = $_POST['idUsuario'];
    $comentario = $_POST['comentario'];

    $m_gestionarUsuarios = new m_gestionarUsuarios();
    return $m_gestionarUsuarios->añadirComentarioEjercicio($comentario, $idEjercicio, $idUsuario, $idTabla);
  }



  public static function getComentarios($idEjercicio, $dni)
  {
    $m_gestionarUsuarios = new m_gestionarUsuarios();
    return $m_gestionarUsuarios->getComentarios($idEjercicio, $dni);
  }

  public static function relacionDeportistaEntrenador($idEnt, $idDep)
  {
    return m_gestionarUsuarios::relacionDeportistaEntrenador($idEnt, $idDep);
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['var']) && $_GET['var'] == 8) {
  $idEnt = $_POST['entrenador'];
  $idDep = $_POST['deportista'];

  $resultado = controlador_usuario::relacionDeportistaEntrenador($idEnt, $idDep);

  if (!$resultado) {
    echo "<script>";
    echo "alert('Error al crear la relación');";
    echo "window.location = '../vistas/gestionarUsuarios.php'";
    echo "</script>";
  }
}
