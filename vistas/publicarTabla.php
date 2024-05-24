<?php
require_once('../controladores/controlador_tabla.php');
require_once('../controladores/controlador_ejercicio.php');
require 'head.php';
@session_start();
$db = conexion_BD();
$resultado = controlador_ejercicio::devolverDatosEjercicios();
if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador') {
?>

<body>

  <?php require 'header_entrenador.php'; ?>

  <div class="container">

    <h1 class="display-4 mt-5 mb-4">Publicar Tabla</h1>

    <form id="contact_form" action="../controladores/controlador_tabla.php?var=0#" method="post" enctype="multipart/form-data" style="margin-right:5px;">

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="idTabla" class="font-weight-bold">ID Tabla:</label>
            <input placeholder="Introduce el ID de la tabla" name="idTabla" type="text" class="form-control" required="">
          </div>
          <div class="form-group">
            <label for="nombre" class="font-weight-bold">Nombre tabla:</label>
            <input placeholder="Introduce el nombre de la tabla" name="nombre" type="text" class="form-control" required="">
          </div>
          <div class="form-group">
            <label for="instrucciones" class="font-weight-bold">Instrucciones:</label>
            <textarea name="instrucciones" rows="7" class="form-control" required=""></textarea>
          </div>
        </div>

        <div class="col-md-6">
          <label class="font-weight-bold">Lista de ejercicios:</label><br><br>
          <div class="col-md-12">
            <?php if ($resultado != null) {
              foreach ($resultado as $reg) { ?>
                <div class="exercise-info">
                  <p><span class="font-weight-bold">Ejercicio:</span> <?php echo $reg['nombre']; ?></p>
                  <?php if ($reg['tipo'] == 'cardio') { ?>
                    <p><span class="font-weight-bold">Tiempo:</span> <?php echo $reg['tiempo']; ?></p>
                  <?php } else { ?>
                    <p><span class="font-weight-bold">Repeticiones:</span> <?php echo $reg['repeticiones']; ?></p>
                    <p><span class="font-weight-bold">Peso:</span> <?php echo $reg['peso']; ?></p>
                  <?php } ?>
                  <input name="lista[]" type="checkbox" id="lista[]" value="<?php echo $reg['idEjercicio']; ?>" autofocus="" readonly>
                  <div class="exercise-image">
                    <img alt="Imagen" src="../images/ejercicios/<?php echo $reg['URLImagen']; ?>" class="img-fluid">
                  </div>
                </div>
                <br>
                <br>
                <br>
            <?php }
            } ?>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <button type="submit" id="submit" name="submit" class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Publicar Tabla</button>
        </div>

        <div class="col-md-6">
          <a href="gestionarTablas.php" class="btn btn-secondary btn-lg btn-block"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</a>
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
