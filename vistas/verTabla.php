<?php
require 'head.php';
require_once('../controladores/controlador_tabla.php');
require_once '../controladores/controlador_ejercicio.php';
@session_start();
$db = conexion_BD();
$idTabla = $_GET['id'];
$tabla = controlador_tabla::getTabla($idTabla);
$resultado = controlador_tabla::devolverDatosEjercicioTabla($idTabla);
if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador') {
  
?>
  <body>

  <?php require 'header_entrenador.php'; ?>

    <div class="container">
      <p style="font-size: -webkit-xxx-large;" id="actividades">Datos Tabla</p>
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
          <table class="table table-bordered">
            <?php
            if ($tabla != null) {
              foreach ($tabla as $reg) {
            ?>
                <tr>
                  <th>Nombre Tabla</th>
                  <td><?php echo $reg['nombre']; ?></td>
                </tr>
                <tr>
                  <th>Instrucciones</th>
                  <td><?php echo $reg['instrucciones']; ?></td>
                </tr>
            <?php
              }
            }
            ?>
          </table>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
          <h3>Lista de ejercicios:</h3>
          <?php
          if ($tabla != null) {
            foreach ($resultado as $reg2) {
              ?>
              <div class="card mb-3">
                <div class="row g-0">
                  <div class="col-md-4">
                    <?php echo "<img alt=\"Imagen\" src=\"" . "../images/ejercicios/" . $reg2['URLImagen'] . "\" class=\"img-fluid rounded-start\" style=\"max-width: 100%;\">"; ?>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $reg2['nombre']; ?></h5>
                      <p class="card-text"><?php echo $reg2['descripcion']; ?></p>               
                    </div>
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <a href="gestionarTablas.php" class="btn btn-default2"><span class="glyphicon glyphicon-step-backward" style="margin-right: 5px;"></span>Atrás</a>
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
}
?>
