<?php
@session_start();
require_once '../funciones/conexion.php';
require_once '../controladores/controlador_actividad.php';
require 'head.php';
$db = conexion_BD();

$idActividad = $_GET['id'];
$result = controlador_actividad::devolverActividad($idActividad);

if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {
?>

  <body>

    <?php require 'header_admin.php' ?>

    <div class="container">
      <h1 class="text-center">Modificar Actividad</h1>

      <form id="contact_form" action="../controladores/controlador_modActividad.php" method="post" enctype="multipart/form-data" style="margin-right:5px;">

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="nombreA">Nombre Actividad:</label>
              <input value="<?php echo $result['nombre'] ?>" name="actualizarnombre" type="text" class="form-control rounded-0" required>
            </div>
            <div class="form-group">
              <label for="tipo">Tipo Actividad:</label>
              <input name="actualizartipo" class="form-control rounded-0" type="text" value="<?php echo $result['tipo']; ?>" placeholder="<?php echo $result['tipo']; ?>" required>

            </div>
            <div class="form-group">
              <label for="descripcion">Descripción:</label>
              <textarea name="actualizardescrip" rows="7" class="form-control rounded-0" required><?php echo $result['descripcion']; ?></textarea>
            </div>
            <div class="form-group">
              <label for="lugar">Lugar:</label>
              <input type="text" name="actualizarlugar" value="<?php echo $result['lugar']; ?>" class="form-control rounded-0" required>
            </div>
          </div>
        </div>

        <input type="hidden" name="actualizarid" value="<?php echo $result['idActividad']; ?>">
        <div class="row">
          <div class="col-sm-6">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Guardar Cambios</button>
            <a href="verActividad.php?id=<?php echo $result['idActividad']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
          </div>
        </div>

      </form>
    </div>

  </body>

  </html>

  <?php
} else {
  if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista') {
    echo "<script>";
    echo "alert('No tienes permisos para entrar en esta página');";
    echo "window.location = '../vistas/deportista.php'";
    echo "</script>";
    exit();
  } else {
    if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador') {
  ?>

      <body>

        <?php require 'header_entrenador.php' ?>

        <div class="container">
          <h1 class="text-center">Modificar Actividad</h1>

          <form id="contact_form" action="../controladores/controlador_modActividad.php" method="post" enctype="multipart/form-data" style="margin-right:5px;">

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="nombreA">Nombre Actividad:</label>
                  <input value="<?php echo $result['nombre'] ?>" name="actualizarnombre" type="text" class="form-control rounded-0" required>
                </div>
                <div class="form-group">
                  <label for="tipo">Tipo Actividad:</label>
                  <input name="actualizartipo" class="form-control rounded-0" type="text" value="<?php echo $result['tipo']; ?>" placeholder="<?php echo $result['tipo']; ?>" required>

                </div>
                <div class="form-group">
                  <label for="descripcion">Descripción:</label>
                  <textarea name="actualizardescrip" rows="7" class="form-control rounded-0" required><?php echo $result['descripcion']; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="lugar">Lugar:</label>
                  <input type="text" name="actualizarlugar" value="<?php echo $result['lugar']; ?>" class="form-control rounded-0" required>
                </div>
              </div>
            </div>

            <input type="hidden" name="actualizarid" value="<?php echo $result['idActividad']; ?>">
            <div class="row">
              <div class="col-sm-6">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Guardar Cambios</button>
                <a href="verActividadEntrenador.php?id=<?php echo $result['idActividad']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
              </div>
            </div>

          </form>
        </div>

      </body>

      </html>
<?php
    }
  }
}
?>