<?php
@session_start();

if (isset($_SESSION['userID']) && $_SESSION['userType'] == 'Deportista' && $_SESSION['connected'] == true) {
  $var = $_GET['id'];

  require_once '../funciones/conexion.php';
  require_once '../funciones/sesion.php';
  require_once '../controladores/controlador_sesion.php';
  require_once '../controladores/controlador_usuario.php';
  require 'head.php';

  $bd = conexion_BD();
  $result = controlador_sesion::getSesionesActividad($var);

?>

  <body>

    <?php require 'header_deportista.php'; ?>

    <div class="container">


      <p style="font-size: -webkit-xxx-large;" id="actividades">Sesiones</p>

      <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped">

          <thead>

            <tr>
              <th>ID Sesion</th>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Monitor</th>
              <th>Plazas disponibles</th>


            </tr>

          </thead>

          <tbody>


            <?php

            foreach ($result as $reg) {

            ?>




              <tr>
                <td><?php echo $reg['idSesion']; ?></td>
                <td><?php echo $reg['fecha']; ?></td>
                <td><?php echo $reg['hora']; ?></td>
                <td><?php $aux = controlador_usuario::devolverUsuario($reg['Usuario_DNI']);
                    echo $aux['nombre']; ?></td>
                <td><?php echo $reg['nPlazasActual']; ?></td>
                <td>
                  <a href="reservarSesion.php?idSesion=<?php echo $reg['idSesion']; ?>" style="text-decoration: none;"><button id="botonGuardarCambios" type="button" class="btn btn-default2">Reservar Sesion</button></a>
                </td>

                <td>
                  <a href="cancelarReservaSesion.php?idSesion=<?php echo $reg['idSesion']; ?>" style="text-decoration: none;"><button id="botonEliminar" type="button" class="btn btn-default2">Cancelar reserva Sesion</button></a>
                </td>

              </tr>
  </body>

  </html>
<?php

            }
          } else {

            if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {
              echo "<script>";
              echo "alert('No tienes permisos para entrar en esta pagina');";
              echo "window.location = '../vistas/administrador.php'";
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