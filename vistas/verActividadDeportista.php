<?php
@session_start();
require_once '../funciones/sesion.php';
require_once '../funciones/conexion.php';
require_once '../controladores/controlador_actividad.php';
require 'head.php';

$db = conexion_BD();
$idActividad = $_GET['id'];
$result = controlador_actividad::devolverActividad($idActividad);

if (isset($_SESSION['userID']) && $_SESSION['userType'] == 'Deportista' && $_SESSION['connected'] == true) {
?>

  <body>
    <?php require 'header_deportista.php'; ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center">Datos Actividad:</h1>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="nombre">
              <h2 class="lead">Nombre Actividad: <?php echo $result['nombre']; ?></h2>
            </label>
          </div>
          <div class="form-group">
            <label for="tipo">
              <h2 class="lead">Tipo Actividad: <?php echo $result['tipo']; ?></h2>
            </label>
          </div>
          <div class="form-group">
            <label for="descripcion">
              <h2 class="lead">Descripción:</h2>
            </label>
            <textarea name="descripcion" readonly rows="7" class="form-control"><?php echo $result['descripcion']; ?></textarea>
          </div>
          <div class="form-group">
            <label for="lugar">
              <h2 class="lead">Lugar: <?php echo $result['lugar']; ?></h2>
            </label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
            <a href="gestionarActividades.php" class="btn btn-default"><span class="glyphicon glyphicon-step-backward" style="margin-right: 5px;"></span>Atrás</a>
          </div>
        </div>
      </div>
    </div>
  </body>

  </html>

<?php
} else {

  if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {
    echo "<script>";
    echo "alert('No tienes permisos para entrar en esta pagina');";
    echo "window.location = '../vistas/administrador.php'";
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