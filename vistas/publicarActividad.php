<?php
@session_start();
require 'head.php';
require_once('../controladores/controlador_actividad.php');
if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {

?>

  <body>


    <?php require 'header_admin.php' ?>


    <div class="container">
      <h1 class="text-center" id="actividades">Publicar Actividad</h1>

      <form id="contact_form" action="../controladores/controlador_actividad.php?var=0#" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label for="nombreA">Nombre Actividad:</label>
          <input placeholder="Introduce el nombre de la actividad" name="nombreA" type="text" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="tipo">Tipo Actividad:</label>
          <input name="tipo" class="form-control" type="text" required>

        </div>

        <div class="form-group">
          <label for="descripcion">Descripción:</label>
          <textarea name="descripcion" rows="7" cols="44" class="form-control" required></textarea>
        </div>

        <div class="form-group">
          <label for="lugar">Lugar:</label>
          <input type="text" name="lugar" placeholder="Introduce el lugar" class="form-control" required>
        </div>

        <div class="row">
          <div class="col-xs-6 col-md-3">
            <button type="submit" id="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Publicar Actividad</button>
          </div>
          <div class="col-xs-6 col-md-3">
            <a href="gestionarActividades.php" class="btn btn-danger">Cancelar</a>
          </div>
        </div>

      </form>
    </div>


  </body>

  </html>

<?php
} else {

  if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista') {
    echo "<script>";
    echo "alert('No tienes permisos para entrar en esta pagina');";
    echo "window.location = '../vistas/deportista.php'";
    echo "</script>";
    exit();
  } else {
    if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador') {

      echo "<script>";
      echo "alert('No tienes permisos para entrar en esta pagina');";
      echo "window.location = '../vistas/entrenador.php'";
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
}
?>