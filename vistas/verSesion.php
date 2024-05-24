<?php
@session_start();
require 'head.php';
require_once '../funciones/conexion.php';
require_once '../controladores/controlador_sesion.php';
require_once '../controladores/controlador_usuario.php';
$db = conexion_BD();
$id = $_GET['idSesion'];

$result = controlador_sesion::devolverDatosSesion($id);
$users = controlador_sesion::devolverInscritos($id);

if (isset($_SESSION['userID']) && $_SESSION['userType'] == 'Administrador' && $_SESSION['connected'] == true) {


?>

  <body>

    <?php require 'header_admin.php' ?>

    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
          <h1 class="display-3">Datos Sesión:</h1>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
          <div>
            <br />
            <label for="sesion" class="lead">
              <p>ID Sesión: <?php echo $result['idSesion']; ?></p>
            </label>
            <br />
          </div>
          <div>
            <br />
            <label for="fecha" class="lead">
              <p>Fecha: <?php echo date("d-m-Y", strtotime($result['fecha'])); ?></p>
            </label>
            <br />
          </div>
          <div>
            <br />
            <label for="hora" class="lead">
              <p>Hora: <?php echo date("H:i", strtotime($result['hora'])); ?></p>
            </label>
            <br />
          </div>
          <div>
            <br />
            <label for="plazas" class="lead">
              <p>Número de Plazas: <?php echo $result['nPlazasMax']; ?></p>
            </label>
          </div>
          <div>
            <br />
            <label for="plazas" class="lead">
              <p>Número de Plazas actual: <?php echo $result['nPlazasActual']; ?></p>
            </label>
          </div>
          <div>
            <br />
            <label for="usuario" class="lead">
              <p>Entrenador: <?php $aux = controlador_usuario::devolverUsuario($result['Usuario_DNI']);
                              echo ($aux['nombre']);
                              echo (", ");
                              echo ($aux['apellidos']); ?></p>
            </label><br />
          </div>
          <div>
            <br />
            <label for="actividad" class="lead">
              <p>ID Actividad: <?php echo $result['Actividad_idActividad']; ?></p>
            </label><br />
          </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="gestionarActividades.php" class="btn btn-secondary"><span class="glyphicon glyphicon-step-backward"></span> Atrás</a>
        </div>
        <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>
                  <h2>Nombre Deportistas Inscritos</h2>
                </th>
              </tr>
            </thead>
            <tbody>

              <?php

              foreach ($users as $reg2) {
              ?>
                <tr>

                  <td><?php $aux = controlador_usuario::devolverUsuario($reg2["Usuario_DNI"]);
                      echo ($aux["nombre"]);
                      echo " ,";
                      echo ($aux["apellidos"]); ?></td>
                </tr>

              <?php
              } ?>
            </tbody>

          </table>
        </div>

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
            require 'header_entrenador.php'

        ?>



            <div class="container">
              <div class="row">
                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                  <h1 class="display-3">Datos Sesión:</h1>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                  <div>
                    <br />
                    <label for="sesion" class="lead">
                      <p>ID Sesión: <?php echo $result['idSesion']; ?></p>
                    </label>
                    <br />
                  </div>
                  <div>
                    <br />
                    <label for="fecha" class="lead">
                      <p>Fecha: <?php echo date("d-m-Y", strtotime($result['fecha'])); ?></p>
                    </label>
                    <br />
                  </div>
                  <div>
                    <br />
                    <label for="hora" class="lead">
                      <p>Hora: <?php echo date("H:i", strtotime($result['hora'])); ?></p>
                    </label>
                    <br />
                  </div>
                  <div>
                    <br />
                    <label for="plazas" class="lead">
                      <p>Número de Plazas: <?php echo $result['nPlazasMax']; ?></p>
                    </label>
                  </div>
                  <div>
                    <br />
                    <label for="plazas" class="lead">
                      <p>Número de Plazas actual: <?php echo $result['nPlazasActual']; ?></p>
                    </label>
                  </div>
                  <div>
                    <br />
                    <label for="usuario" class="lead">
                      <p>Entrenador: <?php $aux = controlador_usuario::devolverUsuario($result['Usuario_DNI']);
                                      echo ($aux['nombre']);
                                      echo (", ");
                                      echo ($aux['apellidos']); ?></p>
                    </label><br />
                  </div>
                  <div>
                    <br />
                    <label for="actividad" class="lead">
                      <p>ID Actividad: <?php echo $result['Actividad_idActividad']; ?></p>
                    </label><br />
                  </div>
                </div>
                <div class="col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
                  <a href="gestionarActividades.php" class="btn btn-secondary"><span class="glyphicon glyphicon-step-backward"></span> Atrás</a>
                </div>
                <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>
                          <h2>Nombre Deportistas Inscritos</h2>
                        </th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php

                      foreach ($users as $reg2) {
                      ?>
                        <tr>

                          <td><?php $aux = controlador_usuario::devolverUsuario($reg2["Usuario_DNI"]);
                              echo ($aux["nombre"]);
                              echo " ,";
                              echo ($aux["apellidos"]); ?></td>
                        </tr>

                      <?php
                      } ?>
                    </tbody>

                  </table>
                </div>
          <?php
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