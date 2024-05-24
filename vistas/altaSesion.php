<?php
@session_start();
require_once('../controladores/controlador_sesion.php');
require_once('../controladores/controlador_usuario.php');
require 'head.php';
$var = $_GET['id'];

$result = controlador_usuario::getEntrenadores();

if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {
?>
  <script type="text/javascript">
    function valida(f) {
      var ok = true;
      var msg = "";
      if ((f.elements["plazas"].value) < (f.elements["acplazas"].value)) {
        msg += "El número de plazas actuales debe ser menor o igual al número de plazas asigado.";
        ok = false;
      }

      if (ok == false)
        alert(msg);
      return ok;
    }
  </script>




  <body>

    <?php
    require_once('../controladores/controlador_sesion.php');
    require 'header_admin.php'
    ?>

    <div class="container">
      <p class="h1">Nueva Sesión</p>

      <form id="contact_form" action="../controladores/controlador_sesion.php?var=0#" method="post" onsubmit="return valida(this)" enctype="multipart/form-data" style="margin-right:5px;">
        <div>
          <br />
          <label for="fecha" class="lead">Fecha:</label><br />
          <input placeholder="Introduce la fecha" name="fecha" type="date" class="form-control" required="" />
          <br />
        </div>

        <div>
          <br />
          <label for="hora" class="lead">Hora:</label><br />
          <input placeholder="Introduce la hora" name="hora" type="time" class="form-control" required="" />
          <br />
        </div>

        <div>
          <br />
          <label for="plazas" class="lead">Plazas:</label><br />
          <input placeholder="Plazas" id="plazas" name="plazas" type="number" min="1" max="999" class="form-control" required="" />
          <br />
        </div>

        <div>
          <br />
          <label for="acplazas" class="lead">Plazas ACTUALES:</label><br />
          <input placeholder="Plazas" id="acplazas" name="acplazas" type="number" min="0" max="999" class="form-control" required="" />
          <br />
        </div>

        <div>
          <label for="user" class="lead">Asignar Entrenador:</label><br />
          <div class="form-group">
            <select name="user" class="form-control">
              <?php
              if ($result != null) {
                foreach ($result as $usuario) {
              ?>
                  <option value="<?php echo $usuario['DNI']; ?>"><?php echo $usuario['nombre']; ?>, <?php echo $usuario['apellidos']; ?></option>
              <?php
                }
              }
              ?>
            </select>
          </div>
        </div>

        <div>
          <br />
          <label for="actividad" class="lead">ID Actividad:</label><br />
          <input type="text" name="actividad" value="<?php echo $var ?>" readonly="readonly" class="form-control">
          <br />
        </div>

        <div class="row">
          <br />
          <form class="col-xs-5 col-sm-3 col-md-3 col-lg-3" method="post" action="" onsubmit="return valida(this)">
            <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
              <a href="gestionarActividades.php"><button type="submit" id="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Publicar sesión</button></a>
            </div>
          </form>

          <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
            <a href="gestionarActividades.php" class="btn btn-danger">Cancelar</a>
          </div>
        </div>
      </form>
    </div>

  </body>

  </html>

<?php
} else {

  if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador') {
    echo "<script>";
    echo "alert('No tienes permisos para entrar en esta pagina');";
    echo "window.location = '../vistas/entrenador.php'";
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