<?php
@session_start();

require 'head.php';
require_once '../funciones/conexion.php';
require_once '../controladores/controlador_ejercicio.php';
$db = conexion_BD();
$idEjercicio = $_GET['id'];
$result = controlador_ejercicio::devolverDatosEjercicio($idEjercicio);

if (isset($_SESSION['userID']) && $_SESSION['userType'] == 'Administrador' && $_SESSION['connected'] == true) {


?>

  <body>

    <?php require 'header_admin.php' ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Datos Ejercicio:</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <p class="font-weight-bold">ID Ejercicio: <?php echo $result['idEjercicio']; ?></p>
          <p class="font-weight-bold">Nombre Ejercicio: <?php echo $result['nombre']; ?></p>
          <p class="font-weight-bold">Descripción:</p>
          <textarea class="form-control" readonly rows="7"><?php echo $result['descripcion']; ?></textarea>
          <?php if ($result['tipo'] == 'cardio') { ?>
            <p class="font-weight-bold">Tiempo: <?php echo $result['tiempo']; ?></p>
          <?php } else if ($result['tipo'] == 'resistencia') { ?>
            <p class="font-weight-bold">Tiempo: <?php echo $result['tiempo']; ?></p>
            <p class="font-weight-bold">Peso: <?php echo $result['peso']; ?></p>
          <?php } else { ?>
            <p class="font-weight-bold">Repeticiones: <?php echo $result['repeticiones']; ?></p>
            <p class="font-weight-bold">Peso: <?php echo $result['peso']; ?></p>
          <?php } ?>
          <div class="mt-3">
            <label class="font-weight-bold">Imagen:</label>
            <img src="../images/ejercicios/<?php echo $result['URLImagen']; ?>" class="img-fluid" alt="Imagen Ejercicio">
          </div>
        </div>
        <div class="col-md-6">
          <div class="btn-group mt-4" role="group">
            <a href="modificarEjercicio.php?id=<?php echo $result['idEjercicio']; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-open" style="margin-right: 5px;"></span>Modificar Ejercicio</a>
          </div>
          <form action="../controladores/controlador_ejercicio.php?var=1#" method="post">
            <input type="hidden" name="idEjercicio" value="<?php echo $result['idEjercicio']; ?>">
            <input type="hidden" name="submit" value="true">
            <div class="btn-group mt-4" role="group">
              <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove" style="margin-right: 5px;"></span>Eliminar Ejercicio</button>
            </div>
          </form>
          <div class="btn-group mt-4" role="group">
            <a href="gestionarEjercicios.php" class="btn btn-secondary"><span class="glyphicon glyphicon-step-backward" style="margin-right: 5px;"></span>Atrás</a>
          </div>
        </div>
      </div>
    </div>

  </body>

  </html>



<?php
} else if (isset($_SESSION['userID']) && $_SESSION['userType'] == 'Entrenador' && $_SESSION['connected'] == true) {
  require 'header_entrenador.php'

?>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="display-4">Datos Ejercicio:</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <p class="font-weight-bold">ID Ejercicio: <?php echo $result['idEjercicio']; ?></p>
        <p class="font-weight-bold">Nombre Ejercicio: <?php echo $result['nombre']; ?></p>
        <p class="font-weight-bold">Descripción:</p>
        <textarea class="form-control" readonly rows="7"><?php echo $result['descripcion']; ?></textarea>
        <?php if ($result['tipo'] == 'cardio') { ?>
          <p class="font-weight-bold">Tiempo: <?php echo $result['tiempo']; ?></p>
        <?php } else if ($result['tipo'] == 'resistencia') { ?>
          <p class="font-weight-bold">Tiempo: <?php echo $result['tiempo']; ?></p>
          <p class="font-weight-bold">Peso: <?php echo $result['peso']; ?></p>
        <?php } else { ?>
          <p class="font-weight-bold">Repeticiones: <?php echo $result['repeticiones']; ?></p>
          <p class="font-weight-bold">Peso: <?php echo $result['peso']; ?></p>
        <?php } ?>
        <div class="mt-3">
          <label class="font-weight-bold">Imagen:</label>
          <img src="../images/ejercicios/<?php echo $result['URLImagen']; ?>" class="img-fluid" alt="Imagen Ejercicio">
        </div>
      </div>
      <div class="col-md-6">
        <div class="btn-group mt-4" role="group">
          <a href="modificarEjercicio.php?id=<?php echo $result['idEjercicio']; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-open" style="margin-right: 5px;"></span>Modificar Ejercicio</a>
        </div>
        <form action="../controladores/controlador_ejercicio.php?var=1#" method="post">
          <input type="hidden" name="idEjercicio" value="<?php echo $result['idEjercicio']; ?>">
          <input type="hidden" name="submit" value="true">
          <div class="btn-group mt-4" role="group">
            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove" style="margin-right: 5px;"></span>Eliminar Ejercicio</button>
          </div>
        </form>
        <div class="btn-group mt-4" role="group">
          <a href="gestionarEjercicios.php" class="btn btn-secondary"><span class="glyphicon glyphicon-step-backward" style="margin-right: 5px;"></span>Atrás</a>
        </div>
      </div>
    </div>
  </div>

  </body>

  </html>

<?php
} else if (isset($_SESSION['userID']) && $_SESSION['userType'] == 'Deportista' && $_SESSION['connected'] == true) {
  require 'header_deportista.php'

?>

  <body>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Datos Ejercicio:</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <p class="font-weight-bold">ID Ejercicio: <?php echo $result['idEjercicio']; ?></p>
          <p class="font-weight-bold">Nombre Ejercicio: <?php echo $result['nombre']; ?></p>
          <p class="font-weight-bold">Descripción:</p>
          <textarea class="form-control" readonly rows="7"><?php echo $result['descripcion']; ?></textarea>
          <?php if ($result['tipo'] == 'cardio') { ?>
            <p class="font-weight-bold">Tiempo: <?php echo $result['tiempo']; ?></p>
          <?php } else if ($result['tipo'] == 'resistencia') { ?>
            <p class="font-weight-bold">Tiempo: <?php echo $result['tiempo']; ?></p>
            <p class="font-weight-bold">Peso: <?php echo $result['peso']; ?></p>
          <?php } else { ?>
            <p class="font-weight-bold">Repeticiones: <?php echo $result['repeticiones']; ?></p>
            <p class="font-weight-bold">Peso: <?php echo $result['peso']; ?></p>
          <?php } ?>
          <div class="mt-3">
            <label class="font-weight-bold">Imagen:</label>
            <img src="../images/ejercicios/<?php echo $result['URLImagen']; ?>" class="img-fluid" alt="Imagen Ejercicio">
          </div>
        </div>
        <div class="col-md-6">
          <div class="btn-group mt-4" role="group">
            <a href="modificarEjercicio.php?id=<?php echo $result['idEjercicio']; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-open" style="margin-right: 5px;"></span>Modificar Ejercicio</a>
          </div>
          <form action="../controladores/controlador_ejercicio.php?var=1#" method="post">
            <input type="hidden" name="idEjercicio" value="<?php echo $result['idEjercicio']; ?>">
            <input type="hidden" name="submit" value="true">
            <div class="btn-group mt-4" role="group">
              <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove" style="margin-right: 5px;"></span>Eliminar Ejercicio</button>
            </div>
          </form>
          <div class="btn-group mt-4" role="group">
            <a href="gestionarEjercicios.php" class="btn btn-secondary"><span class="glyphicon glyphicon-step-backward" style="margin-right: 5px;"></span>Atrás</a>
          </div>
        </div>
      </div>
    </div>

  </body>

  </html>

<?php
} else {

  echo "<script>";
  echo "alert('No tienes permisos para entrar en esta pagina');";
  echo "window.location = '../vistas/principal.php'";
  echo "</script>";
  exit();
}

?>