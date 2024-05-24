<?php
@session_start();
require_once '../funciones/sesion.php';
require 'head.php';
require_once '../funciones/conexion.php';
require_once '../controladores/controlador_actividad.php';
require_once '../controladores/controlador_inscripcion.php';
require_once '../controladores/controlador_usuario.php';

$idActividad = $_GET['id'];
$result = controlador_actividad::devolverActividad($idActividad);
$users = controlador_inscripcion::devolverInscritos($idActividad);

if(isset($_SESSION['userID']) && $_SESSION['userType'] == 'Entrenador' && $_SESSION['connected'] == true){
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
        <div class="row">
          <div class="col-md-6">
            <a href="modificarActividad.php?id=<?php echo $result['idActividad']; ?>" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-floppy-open"></span> Modificar Actividad</a>
          </div>
          <div class="col-md-6">
            <form action="../controladores/controlador_actividad.php?var=1#" method="post">
              <input type="hidden" name="idActividad" value="<?php echo $result['idActividad']; ?>">
              <input type="hidden" name="submit" value="true">
              <button type="submit" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-floppy-remove"></span> Eliminar Actividad</button>
            </form>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-6 offset-md-3">
            <a href="gestionarActividades.php" class="btn btn-default btn-block"><span class="glyphicon glyphicon-step-backward"></span> Atrás</a>
          </div>
        </div>
      </div>
    </div>
    <div class="table-responsive mt-4">
      <table class="table table-striped">
        <thead>
          <tr>
            <th><h2 class="lead">Nombre Deportistas Inscritos</h2></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $reg2) { ?>
          <tr>
            <td><?php $aux=controlador_usuario::devolverUsuario($reg2["Usuario_DNI"]); echo($aux["nombre"]); echo " ,"; echo($aux["apellidos"]);?></td>
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
  if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {
    echo "<script>";
    echo "alert('No tienes permisos para entrar en esta página');";
    echo "window.location = '../vistas/administrador.php'";
    echo "</script>";
    exit();
  } else {
    if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista') {
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
