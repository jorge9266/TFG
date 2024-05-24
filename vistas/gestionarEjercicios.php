<?php
@session_start();
require 'head.php';
require_once '../funciones/conexion.php';
require_once '../controladores/controlador_ejercicio.php';
$bd = conexion_BD();
$result = controlador_ejercicio::devolverDatosEjercicios();

if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {
?>

  <body>

    <?php require 'header_admin.php' ?>

    <div class="container">

      <h1 class="display-4 mt-5 mb-4">Ejercicios</h1>

      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2">
          <a href="altaEjercicio.php" class="btn btn-primary btn-block">Crear Ejercicio</a>
        </div>
      </div>

      <div class="table-responsive mt-4">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nombre del ejercicio</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($result as $reg) { ?>
              <tr>
                <td><?php echo $reg['nombre']; ?></td>
                <td>
                  <a href="verEjercicio.php?id=<?php echo $reg['idEjercicio']; ?>" class="btn btn-secondary">Ver ejercicio</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

    </div>

  </body>

  </html>
  <?php
} else {
  if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador') {

  ?>

    <?php
    require 'head.php';
    ?>


<body>

<?php require 'header_entrenador.php' ?>

<div class="container">

  <h1 class="display-4 mt-5 mb-4">Ejercicios</h1>

  <div class="row">
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2">
      <a href="altaEjercicio.php" class="btn btn-primary btn-block">Crear Ejercicio</a>
    </div>
  </div>

  <div class="table-responsive mt-4">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nombre del ejercicio</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($result as $reg) { ?>
          <tr>
            <td><?php echo $reg['nombre']; ?></td>
            <td>
              <a href="verEjercicio.php?id=<?php echo $reg['idEjercicio']; ?>" class="btn btn-secondary">Ver ejercicio</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

</div>

</body>
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
}
?>