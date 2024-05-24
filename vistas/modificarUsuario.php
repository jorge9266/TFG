<?php
@session_start();


require_once '../funciones/conexion.php';
require_once '../controladores/controlador_usuario.php';
require 'head.php';
$db = conexion_BD();
$dni = $_GET['id'];
$result = controlador_usuario::devolverUsuario($dni);
if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {

?>
  <script type="text/javascript">
    function valida(f) {
      var ok = true;
      var msg = "";
      emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

      if (!(emailRegex.test(f.elements["actualizaremail"].value))) {
        msg += "La dirección de correo electrónico no parece válida.";
        ok = false;
      }

      if (ok == false)
        alert(msg);
      return ok;
    }
  </script>

  <?php require 'header_admin.php'; ?>

  <div class="container">

    <p style="font-size: -webkit-xxx-large; ">Modificar Usuario</p>


    <form id="contact_form" action="../controladores/controlador_usuario.php?var=2#" method="post" onsubmit="return valida(this)" enctype="multipart/form-data" style="margin-right:5px;">

      <div class="row">

        <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">

          <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input value="<?php echo $result['nombre']; ?>" name="actualizarnombre" type="text" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="tipo">Contraseña:</label>
            <input value="<?php echo $result['password']; ?>" name="actualizarpass" type="password" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="dni">DNI:</label>
            <input value="<?php echo $result['DNI']; ?>" name="actualizardni" type="text" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="actualizarapellidos" value="<?php echo $result['apellidos']; ?>" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="actualizaremail" name="actualizaremail" value="<?php echo $result['email']; ?>" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select name="actualizartipo" class="form-control" required>
              <option> <?php echo $result['tipo']; ?> </Option>
              <option> Administrador </option>
              <option> Entrenador </Option>
              <option> Deportista </Option>
            </select>
          </div>


        <input type="hidden" name="actualizardni" value="<?php echo $result['DNI']; ?>"></input>
        <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="#?id=<?php echo $result['DNI']; ?>" style="text-decoration: none; "><button type="submit" class="btn btn-default3" id="botonGuardarCambios" name="submit" style="background-color: #279B13; color: black;"><span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Guardar Cambios</button></a>
        </div>

        <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="gestionarUsuarios.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</button></a>
        </div>
      </div>
    </form>

  </div>


  </body>

  </html>
<?php
} else {

  if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista') {
    echo "<script>";
    echo "alert('No tienes permisos para entrar en esta pagina');";
    echo "window.location = '../vistas/deportista.php'";
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