<?php
require 'head.php';
require_once '../funciones/conexion.php';
require_once '../controladores/controlador_tabla.php';
require_once '../controladores/controlador_ejercicio.php';
@session_start();
$db = conexion_BD();
$idTabla = $_GET['id'];
$tabla = controlador_tabla::getTabla($idTabla);
$resultado = controlador_tabla::devolverDatosEjercicioTabla($idTabla);
$resultado2 = controlador_ejercicio::devolverDatosEjercicios();
if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador') {
?>

  <body>

    <?php require 'header_entrenador.php'; ?>

    <div class="container">

      <h1 class="text-center" style="font-size: 36px;">Modificar Tablas</h1>

      <form id="contact_form" action="../controladores/controlador_tabla.php?var=2#" method="post" enctype="multipart/form-data">
        <div class="row">

          <div class="col-md-4">
            <?php
            if ($tabla != null) {
              foreach ($tabla as $reg) {
            ?>
                <div class="form-group">
                  <label for="actualizaridTabla">ID Tabla:</label>
                  <input value="<?php echo $reg['idTabla']; ?>" name="actualizaridTabla" type="text" class="form-control" readonly required />
                </div>

                <div class="form-group">
                  <label for="actualizarnombreTabla">Nombre:</label>
                  <input value="<?php echo $reg['nombre']; ?>" name="actualizarnombreTabla" type="text" class="form-control" required />
                </div>

                <div class="form-group">
                  <label for="actualizarinstrucciones">Instrucciones:</label>
                  <textarea name="actualizarinstrucciones" rows="7" class="form-control" required><?php echo $reg['instrucciones']; ?></textarea>
                </div>
            <?php
              }
            }
            ?>
          </div>

          <div class="col-md-4">
            <label>Ejercicios que contiene la tabla:</label><br />
            <?php
            if ($tabla != null) {
              foreach ($resultado as $reg2) {
            ?>
                <p>Ejercicio: <?php echo $reg2['nombre']; ?></p>
                <?php if ($reg2['tipo'] == 'cardio') { ?>
                  <p>Tiempo: <?php echo $reg2['tiempo']; ?></p>
                <?php } else { ?>
                  <p>Repeticiones: <?php echo $reg2['repeticiones']; ?></p>
                  <p>Peso: <?php echo $reg2['peso']; ?></p>
                <?php } ?>
                <img alt="Imagen" src="<?php echo "../images/ejercicios/" . $reg2['URLImagen']; ?>" style="max-width: 70%;" />
            <?php
              }
            }
            ?>
          </div>

          <div class="col-md-4">
            <label>Lista de Ejercicios:</label><br />
            <?php
            if ($resultado2 != null) {
              foreach ($resultado2 as $reg3) {
            ?>
                <div class="form-check">
                  <input name="actualizarlista[]" type="checkbox" id="actualizarlista[]" value="<?php echo $reg3['idEjercicio']; ?>" class="form-check-input" autofocus readonly>
                  <label class="form-check-label" for="actualizarlista[]"><?php echo $reg3['nombre']; ?></label>
                  <?php if ($reg3['tipo'] == 'cardio') { ?>
                    <p>Tiempo: <?php echo $reg3['tiempo']; ?></p>
                  <?php } else { ?>
                    <p>Repeticiones: <?php echo $reg3['repeticiones']; ?></p>
                    <p>Peso: <?php echo $reg3['peso']; ?></p>
                  <?php } ?>
                  <img alt="Imagen" src="<?php echo "../images/ejercicios/" . $reg3['URLImagen']; ?>" style="max-width: 70%;" />
                </div>
            <?php
              }
            }
            ?>
          </div>

          <div class="col-md-12">
            <div class="btn-group" role="group">
              <button type="submit" class="btn btn-success" id="botonGuardarCambios" name="submit"><span class="glyphicon glyphicon-ok"></span> Guardar Cambios</button>
              <a href="gestionarTablas.php" class="btn btn-danger" id="botonEliminar">Cancelar</a>
            </div>
          </div>

        </div>
      </form>

    </div>

  </body>

  </html>

<?php
} else {

  if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {
    echo "<script>";
    echo "alert('No tienes permisos para entrar en esta página');";
    echo "window.location = '../vistas/administrador.php'";
    echo "</script>";
    exit();
  } else {
    if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista') {
      echo "<script>";
      echo "alert('No tienes permisos para entrar en esta página');";
      echo "window.location = '../vistas/deportista.php'";
      echo "</script>";
      exit();
    } else {
      echo "<script>";
      echo "alert('No tienes permisos para entrar en esta página');";
      echo "window.location = '../vistas/principal.php'";
      echo "</script>";
      exit();
    }
  }
}
?>
