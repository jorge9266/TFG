<?php
require_once '../funciones/conexion.php';
require_once '../controladores/controlador_usuario.php';
require_once '../controladores/controlador_tabla.php';
require 'head.php';
@session_start();
$bd = conexion_BD();
$idTabla = $_GET['id'];
$result = controlador_tabla::getDeportistasAsignados($idTabla);
$result2 = controlador_usuario::getDeportistasGeneral();
if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador') {
?>

<body>

  <?php require 'header_entrenador.php' ?>

  <div class="container">

    <div class="row" style="margin-top: 20px; margin-bottom: 10px;">

      <div class="table-responsive col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <h3>Deportistas Asignados</h3>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>DNI</th>
              <th>Nombre</th>
              <th>Apellidos</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result != null) {
              foreach ($result as $usuario) {
            ?>
                <tr>
                  <td><?php echo $usuario['DNI']; ?></td>
                  <td><?php echo $usuario['nombre']; ?></td>
                  <td><?php echo $usuario['apellidos']; ?></td>
                </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="row">
          <div class="col-md-6">
            <form action="../controladores/controlador_tabla.php?var=3#" method="POST" style="margin:10px;">
              <h3>Asignar Deportistas</h3>
              <div class="form-group">
                <select name="DNI" class="form-control">
                  <?php
                  if ($result2 != null) {
                    foreach ($result2 as $usuario2) {
                  ?>
                      <option value="<?php echo $usuario2['DNI']; ?>"><?php echo $usuario2['nombre'] . ', ' . $usuario2['apellidos']; ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
              <input type="hidden" name="idTabla" value="<?php echo $idTabla; ?>">
              <div class="text-center">
                <button type="submit" name="submit" class="btn btn-success">Guardar</button>
              </div>
            </form>
          </div>

          <div class="col-md-6">
            <form action="../controladores/controlador_tabla.php?var=4#" method="POST" style="margin:10px;">
              <h3>Eliminar Deportista Asignado</h3>
              <div class="form-group">
                <select name="DNI" class="form-control">
                  <?php
                  if ($result != null) {
                    foreach ($result as $usuario3) {
                  ?>
                      <option value="<?php echo $usuario3['DNI']; ?>"><?php echo $usuario3['nombre'] . ', ' . $usuario3['apellidos']; ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
              <input type="hidden" name="idTabla" value="<?php echo $idTabla; ?>">
              <div class="text-center">
                <button type="submit" name="submit" class="btn btn-danger">Eliminar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <a href="gestionarTablas.php" class="btn btn-default"><span class="glyphicon glyphicon-step-backward"></span> Atrás</a>
      </div>

    </div>
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
