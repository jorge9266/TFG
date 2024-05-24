<?php
@session_start();

if (isset($_SESSION['userID']) && $_SESSION['userType'] == 'Deportista' && $_SESSION['connected'] == true) {
  require_once '../funciones/conexion.php';
  require_once '../funciones/sesion.php';
  require_once '../controladores/controlador_sesion.php';
  require_once '../controladores/controlador_actividad.php';

  require 'head.php';
  $bd = conexion_BD();
  $result = controlador_sesion::getMisReservas();
?>

  <body>
    <?php require 'header_deportista.php'; ?>
    <div class="container">
      <p style="font-size: -webkit-xxx-large;" id="actividades">Mis Reservas</p>
      <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID Sesion</th>
              <th>Fecha</th>
              <th>Hora</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($result as $reg) {
            ?>
              <tr>
                <td><?php echo $reg['Sesion_idSesion']; ?></td>
                <?php $aux = controlador_sesion::devolverDatosSesion($reg['Sesion_idSesion']); ?>
                <td><?php echo $aux['fecha'] ?></td>
                <td><?php echo $aux['hora'] ?></td>
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