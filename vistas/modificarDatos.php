<?php
@session_start();
require 'head.php';
if (isset($_SESSION['userID'])  &&  $_SESSION['connected']) {

  require_once '../funciones/conexion.php';
  require_once '../controladores/controlador_usuario.php';
  $db = conexion_BD();
  $result = controlador_usuario::devolverUsuario($_SESSION['userID']);
}
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

<body>

  <?php
  if ($_SESSION['userType'] == 'Administrador') {

    require 'header_admin.php';
  ?>


    <div class="container">
      <p style="font-size: 36px; font-weight: bold; margin-bottom: 20px;">Modificar Perfil de Usuario</p>
      <form id="contact_form" action="../controladores/controlador_usuario.php?var=5#" method="post" onsubmit="return valida(this)" enctype="multipart/form-data" style="background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); margin-right: 5px;">

        <div class="col-xs-12 col-sm-6">
          <div>
            <br />
            <label for="DNI" style="margin-right: 5px; font-weight: normal; font-size: 18px;">DNI:</label>
            <input value="<?php echo $result['DNI']; ?>" name="actualizardni" type="text" size="30" required="" readonly="readonly" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
          </div>
          <div>
            <br />
            <label for="nombre" style="margin-right: 5px; font-weight: normal; font-size: 18px;">Nombre:</label>
            <input value="<?php echo $result['nombre']; ?>" name="actualizarnombre" type="text" size="30" required="" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
          </div>
          <div>
            <br />
            <label for="apellidos" style="margin-right: 5px; font-weight: normal; font-size: 18px;">Apellidos:</label>
            <input type="text" name="actualizarapellidos" value="<?php echo $result['apellidos']; ?>" required="" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
          </div>
          <div>
            <br />
            <label for="email" style="margin-right: 5px; font-weight: normal; font-size: 18px;">Email:</label>
            <input type="text" name="actualizaremail" id="actualizaremail" value="<?php echo $result['email']; ?>" required="" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
          </div>
          <div>
            <br />
            <label for="tipo" style="margin-right: 5px; font-weight: normal; font-size: 18px;">Contraseña:</label>
            <input value="<?php echo $result['password']; ?>" name="actualizarpass" type="password" size="30" required="" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
          </div>
          <div>
            <br />
            <label for="tipo" style="margin-right: 5px; font-weight: normal; font-size: 18px;">Tipo de usuario:</label>
            <input value="<?php echo $result['tipo']; ?>" name="actualizartipo" type="text" size="30" required="" readonly="readonly" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
          </div>
        </div>

        <input type="hidden" name="actualizardni" value="<?php echo $result['DNI']; ?>">
        

        <div class="col-xs-12 col-sm-6">
          <div class="row">
            <div class="col-xs-12 col-sm-6" style="margin-top: 10px; margin-bottom: 15px;">
              <button type="submit" class="btn btn-primary" id="botonGuardarCambios" name="submit" style="background-color: #279B13; color: black; width: 100%;"><span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Guardar Cambios</button>
            </div>
            <div class="col-xs-12 col-sm-6" style="margin-top: 10px; margin-bottom: 15px;">
              <a href="verPerfil.php" class="btn btn-secondary" style="text-decoration: none; width: 100%;"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</a>
            </div>
          </div>
        </div>

      </form>
    </div>


</body>

</html>
<?php
  } else if ($_SESSION['userType'] == 'Entrenador') {
    require 'header_entrenador.php';
?>



  <div class="container">
    <p style="font-size: 36px; font-weight: bold; margin-bottom: 20px;">Modificar Perfil de Usuario</p>
    <form id="contact_form" action="../controladores/controlador_usuario.php?var=5#" method="post" onsubmit="return valida(this)" enctype="multipart/form-data" style="background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); margin-right: 5px;">

      <div class="col-xs-12 col-sm-6">
        <div>
          <br />
          <label for="DNI" style="margin-right: 5px; font-weight: normal; font-size: 18px;">DNI:</label>
          <input value="<?php echo $result['DNI']; ?>" name="actualizardni" type="text" size="30" required="" readonly="readonly" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div>
          <br />
          <label for="nombre" style="margin-right: 5px; font-weight: normal; font-size: 18px;">Nombre:</label>
          <input value="<?php echo $result['nombre']; ?>" name="actualizarnombre" type="text" size="30" required="" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div>
          <br />
          <label for="apellidos" style="margin-right: 5px; font-weight: normal; font-size: 18px;">Apellidos:</label>
          <input type="text" name="actualizarapellidos" value="<?php echo $result['apellidos']; ?>" required="" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div>
          <br />
          <label for="email" style="margin-right: 5px; font-weight: normal; font-size: 18px;">Email:</label>
          <input type="text" name="actualizaremail" id="actualizaremail" value="<?php echo $result['email']; ?>" required="" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div>
          <br />
          <label for="tipo" style="margin-right: 5px; font-weight: normal; font-size: 18px;">Contraseña:</label>
          <input value="<?php echo $result['password']; ?>" name="actualizarpass" type="password" size="30" required="" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div>
          <br />
          <label for="tipo" style="margin-right: 5px; font-weight: normal; font-size: 18px;">Tipo de usuario:</label>
          <input value="<?php echo $result['tipo']; ?>" name="actualizartipo" type="text" size="30" required="" readonly="readonly" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
        </div>
      </div>

      <input type="hidden" name="actualizardni" value="<?php echo $result['DNI']; ?>">
      

      <div class="col-xs-12 col-sm-6">
        <div class="row">
          <div class="col-xs-12 col-sm-6" style="margin-top: 10px; margin-bottom: 15px;">
            <button type="submit" class="btn btn-primary" id="botonGuardarCambios" name="submit" style="background-color: #279B13; color: black; width: 100%;"><span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Guardar Cambios</button>
          </div>
          <div class="col-xs-12 col-sm-6" style="margin-top: 10px; margin-bottom: 15px;">
            <a href="verPerfil.php" class="btn btn-secondary" style="text-decoration: none; width: 100%;"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</a>
          </div>
        </div>
      </div>

    </form>
  </div>


  </body>

  </html>





<?php } else if ($_SESSION['userType'] == 'Deportista') {
    require 'header_deportista.php';
?>




  <div class="container">
    <p style="font-size: 36px; font-weight: bold; margin-bottom: 20px;">Modificar Perfil de Usuario</p>
    <form id="contact_form" action="../controladores/controlador_usuario.php?var=5#" method="post" onsubmit="return valida(this)" enctype="multipart/form-data" style="background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); margin-right: 5px;">

      <div class="col-xs-12 col-sm-6">
        <div>
          <br />
          <label for="DNI" style="margin-right: 5px; font-weight: normal; font-size: 18px;">DNI:</label>
          <input value="<?php echo $result['DNI']; ?>" name="actualizardni" type="text" size="30" required="" readonly="readonly" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div>
          <br />
          <label for="nombre" style="margin-right: 5px; font-weight: normal; font-size: 18px;">Nombre:</label>
          <input value="<?php echo $result['nombre']; ?>" name="actualizarnombre" type="text" size="30" required="" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div>
          <br />
          <label for="apellidos" style="margin-right: 5px; font-weight: normal; font-size: 18px;">Apellidos:</label>
          <input type="text" name="actualizarapellidos" value="<?php echo $result['apellidos']; ?>" required="" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div>
          <br />
          <label for="email" style="margin-right: 5px; font-weight: normal; font-size: 18px;">Email:</label>
          <input type="text" name="actualizaremail" id="actualizaremail" value="<?php echo $result['email']; ?>" required="" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div>
          <br />
          <label for="tipo" style="margin-right: 5px; font-weight: normal; font-size: 18px;">Contraseña:</label>
          <input value="<?php echo $result['password']; ?>" name="actualizarpass" type="password" size="30" required="" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div>
          <br />
          <label for="tipo" style="margin-right: 5px; font-weight: normal; font-size: 18px;">Tipo de usuario:</label>
          <input value="<?php echo $result['tipo']; ?>" name="actualizartipo" type="text" size="30" required="" readonly="readonly" style="width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
        </div>
      </div>

      <input type="hidden" name="actualizardni" value="<?php echo $result['DNI']; ?>">
      

      <div class="col-xs-12 col-sm-6">
        <div class="row">
          <div class="col-xs-12 col-sm-6" style="margin-top: 10px; margin-bottom: 15px;">
            <button type="submit" class="btn btn-primary" id="botonGuardarCambios" name="submit" style="background-color: #279B13; color: black; width: 100%;"><span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Guardar Cambios</button>
          </div>
          <div class="col-xs-12 col-sm-6" style="margin-top: 10px; margin-bottom: 15px;">
            <a href="verPerfil.php" class="btn btn-secondary" style="text-decoration: none; width: 100%;"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</a>
          </div>
        </div>
      </div>

    </form>
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