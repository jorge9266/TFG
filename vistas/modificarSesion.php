<?php
@session_start();

require 'head.php';
require_once '../funciones/conexion.php';
require_once '../controladores/controlador_sesion.php';
$db = conexion_BD();
$id = $_GET['id'];
$result = controlador_sesion::devolverDatosSesion($id);
if (isset($_SESSION['userID']) && $_SESSION['userType'] == 'Administrador' && $_SESSION['connected'] == true) {
?>





  <body>


    <header>
      
      <nav class="navbar navbar-default1">
        <div class="container-fluid">
          
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            
            <a class="navbar-brand" href="#"><img src="../images/logo.png" style="margin-top:-10px;"></img></a>
          </div>

          
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="margin-top: 3px;">
            <ul class="nav navbar-nav">

              <li class="current"><a href="../vistas/administrador.php">Principal</a></li>
              <li><a href="../vistas/gestionarUsuarios.php">Gestión de usuarios</a></li>
              <li><a href="../vistas/gestionarActividades.php">Gestión de actividades</a></li>
              <li><a href="../vistas/gestionarEjercicios.php">Gestión de ejercicios</a></li>
              <li><a href="../vistas/verPerfil.php">Ver Perfil</a></li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
              <div class="form-group">
                <button id="modalButton" type="button" class="btn btn-default1" data-toggle="modal" data-target=".bs-example-modal-sm" style="margin-left: 10px;">Cerrar Sesi&oacuten</button>
                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content" id="modalLogin">
                      <div class="modal-header">
                        <h4 style="text-align: center; color:white;" class="modal-title">Cerrar Sesi&oacuten</h4>
                      </div>
                      <div class="text-center">
                        <p style="text-align: center; margin-top: 20px;"><img src="../images/logo-grande.png"></img></p>
                        <button type="submit" class="btn btn-default1" id="botonModificar" style="margin-bottom: 10px;" value="Confirmar" onclick="location='../funciones/cerrar.php'">Cerrar Sesi&oacuten</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </ul>

      </nav>

    </header>


    <div class="container">
      

      <p style="font-size: -webkit-xxx-large; ">Modificar Sesi&oacuten</p>


      <form id="contact_form" action="../controladores/controlador_sesion.php?var=2#" method="post" enctype="multipart/form-data" style="margin-right:5px;">

        <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">

          <div>
            <br />
            <label for="idTabla" style="margin-right:5px; font-weight:normal; font-size: x-large;">ID Sesion: </label>
            <input value="<?php echo $result['idSesion']; ?>" name="actualizaridsesion" type="text" size="30" readonly required="" />
          </div>

          <div>
            <br />
            <label for="nombre" style="margin-right:5px; font-weight:normal; font-size: x-large;">Fecha: </label>
            <input value="<?php echo $result['fecha']; ?>" name="actualizarfecha" type="text" size="30" required="" />
          </div>

          <div>
            <br />
            <label for="tipo" style="margin-right:5px; font-weight:normal; font-size: x-large;">Hora: </label>
            <input value="<?php echo $result['hora']; ?>" name="actualizarhora" type="text" size="30" required="" />
          </div>

          <div>
            <br />
            <label for="instrucciones" style="margin-right:5px; font-weight:normal; font-size: x-large;">Numero de Plazas: </label>
            <input type="text" name="actualizarplazas" value="<?php echo $result['nPlazasMax']; ?>" required=""></input>
          </div>

          <div>
            <br />
            <label for="instrucciones" style="margin-right:5px; font-weight:normal; font-size: x-large;">Numero de Plazas actual: </label>
            <input type="text" name="actualizarplazasactual" value="<?php echo $result['nPlazasActual']; ?>" required=""></input>
          </div>

          <div>
            <br />
            <label for="tipo" style="margin-right:5px; font-weight:normal; font-size: x-large;">DNI Usuario: </label>
            <input value="<?php echo $result['Usuario_DNI']; ?>" name="actualizardni" type="text" size="30" required="" />
          </div>

          <div>
            <br />
            <label for="tipo" style="margin-right:5px; font-weight:normal; font-size: x-large;">ID Actividad: </label>
            <input value="<?php echo $result['Actividad_idActividad']; ?>" name="actualizaridactividad" type="text" size="30" required="" />
          </div>

        </div>

        <input type="hidden" name="actualizarid" value="<?php echo $result['idTabla']; ?>"></input>
        <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="#?id=<?php echo $result['idSesion']; ?>" style="text-decoration: none; "><button type="submit" class="btn btn-default3" id="botonGuardarCambios" name="submit" style="background-color: #279B13; color: black;><span class=" glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Guardar Cambios</button></a>
        </div>

        <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="../vistas/gestionarActividades.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</button></a>
        </div>



      </form>

    </div>
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