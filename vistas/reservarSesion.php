<?php
@session_start();

if (isset($_SESSION['userID']) && $_SESSION['userType'] == 'Deportista' && $_SESSION['connected'] == true) {
  $var = $_GET['idSesion'];

  require_once '../funciones/conexion.php';
  require_once '../funciones/sesion.php';
  require_once '../controladores/controlador_inscripcion.php';
  require_once '../controladores/controlador_sesion.php';
  require 'head.php';
  

?>

  <body>

  <?php require 'header_deportista.php'; ?>

    <div class="container">
      <p style="font-size: 36px; font-weight: bold;" id="actividades">Confirmación</p>
      <form id="contact_form" action="../controladores/controlador_sesion.php?var=3#" method="post" enctype="multipart/form-data" style="margin-right: 5px; background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">

        <div>
          <br />
          <label for="sesion" style="margin-right: 5px; font-weight: normal; font-size: 18px;">ID Sesion:</label><br />
          <input value="<?php echo $var ?>" name="sesion" type="text" size="30" required="" readonly="readonly" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;"><br />
        </div>

        <div>
          <label for="dniU" style="margin-right: 5px; font-weight: normal; font-size: 18px;">DNI:</label><br />
          <input value="<?php echo $_SESSION['userID'] ?>" name="dniU" type="text" size="30" required="" readonly="readonly" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;"><br />
        </div>

        <div class="row">
          <br />
          <div class="col-xs-6 col-sm-4 col-md-4 col-lg-2" style="margin-top: 10px; margin-bottom: 15px;">
            <button type="submit" id="submit" name="submit" class="btn btn-primary" style="background-color: #279B13; color: black; width: 100%;"><span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Confirmar</button>
          </div>
          <div class="col-xs-6 col-sm-4 col-md-4 col-lg-2" style="margin-top: 10px; margin-bottom: 15px;">
            <a href="misActividades.php" class="btn btn-secondary" style="text-decoration: none; width: 100%;"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</a>
          </div>
        </div>

      </form>
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