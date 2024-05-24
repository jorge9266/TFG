<?php
@session_start();
require_once '../funciones/conexion.php';
require_once '../controladores/controlador_ejercicio.php';
require 'head.php';
$db = conexion_BD();
$idEjercicio = $_GET['id'];
$result = controlador_ejercicio::devolverDatosEjercicio($idEjercicio);

?>

<body>



  <?php
  if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {
    require 'header_admin.php'
  ?>


  <?php
  } else if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador') {
    require 'header_entrenador.php'
  ?>

  <?php
  } else {

    if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista') {
      echo "<script>";
      echo "alert('No tienes permisos para entrar en esta pagina');";
      echo "window.location = '../vistas/deportista.php'";
      echo "</script>";
      exit();
    } else {

      echo "<script>";
      echo "alert('No tienes permisos para entrar en esta pagina');";
      echo "window.location = '../vistas/principal.php'";
      echo "</script>";
      exit();
    }
  }

  ?>

  <div class="container">


    <p style="font-size: -webkit-xxx-large; ">Modificar Ejercicio</p>



    <form id="contact_form" action="../controladores/controlador_ejercicio.php?var=2#" method="post" enctype="multipart/form-data" style="margin-right:5px;">

      <div class="col-xs-12 col-sm-6">
        <div class="form-group">
          <label for="idEjercicio">ID Ejercicio:</label>
          <input value="<?php echo $result['idEjercicio'] ?>" name="actualizarid" type="text" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="nombreE">Nombre Ejercicio:</label>
          <input value="<?php echo $result['nombre'] ?>" name="actualizarnombre" type="text" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="descripcion">Descripción:</label>
          <input value="<?php echo $result['descripcion'] ?>" name="actualizardes" type="text" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="repeticiones">Repeticiones:</label>
          <input type="text" name="actualizarrepeticiones" class="form-control" placeholder="xx-xx-xx-xx" value="<?php echo $result['repeticiones'] ?>">
        </div>

        <div class="form-group">
          <label for="peso">Peso:</label>
          <input type="number" min="0" name="actualizarpeso" class="form-control" value="<?php echo $result['peso'] ?>">
        </div>

        <div class="form-group">
          <label for="tiempo">Tiempo:</label>
          <input type="text" name="actualizartiempo" class="form-control" value="<?php echo $result['tiempo'] ?>">
        </div>

        <div class="form-group" style="margin-top: 30px;">
          <label for="imgEjer">Subir Imagen:</label>
          <input type="file" name="actualizarimagen" class="form-control-file" required="">
        </div>

        <div class="form-group">
          <label for="tipo">Tipo Ejercicio:</label>
          <select name="actualizartipo" class="form-control" required="">
            <option><?php echo $result['tipo']; ?></option>
            <option value="brazos">Brazos</option>
            <option value="espalda">Espalda</option>
            <option value="pecho">Pecho</option>
            <option value="piernas">Piernas</option>
            <option value="cardio">Cardio</option>
            <option value="resistencia">Resistencia</option>
          </select>
        </div>
      </div>


      <input type="hidden" name="actualizarid" value="<?php echo $result['idEjercicio']; ?>">

      <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
        <a href="verEjercicio.php?id=<?php echo $result['idEjercicio']; ?>" style="text-decoration: none;">
          <button type="submit" class="btn btn-default3" id="botonGuardarCambios" name="submit" style="background-color: #279B13; color: black;">
            <span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Guardar Cambios
          </button>
        </a>
      </div>


      <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
        <a href="verEjercicio.php?id=<?php echo $result['idEjercicio']; ?>" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</button></a>
      </div>



    </form>

  </div>




</body>

</html>