<?php
@session_start();


$var = $_GET['id'];
require 'head.php';
require_once '../funciones/conexion.php';
require_once '../funciones/sesion.php';
require_once '../controladores/controlador_usuario.php';
require_once '../controladores/controlador_sesion.php';
$bd = conexion_BD();

$result = controlador_sesion::getEsto($var);

if (isset($_SESSION['userID']) && $_SESSION['userType'] == 'Administrador' && $_SESSION['connected'] == true) {
?>

  <body>

    <?php require 'header_admin.php' ?>

    <div class="container">


      <p style="font-size: -webkit-xxx-large;" id="actividades">Sesiones</p>

      <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped">

          <thead>

            <tr>
              <th>Fecha</th>
              <th>Hora</th>

              <th>Entrenador</th>
            </tr>

          </thead>

          <tbody>


            <?php
            foreach ($result as $reg) {
            ?>
              <tr>
                <td><?php echo date("d-m-Y", strtotime($reg['fecha'])); ?></td>
                <td><?php echo date("H:i", strtotime($reg['hora'])); ?></td>
                <td><?php $aux = controlador_usuario::devolverUsuario($reg['Usuario_DNI']);
                    echo ($aux['nombre']);
                    echo (", ");
                    echo ($aux['apellidos']); ?></td>
                <td>
                  <a href="../vistas/verSesion.php?idSesion=<?php echo $reg['idSesion']; ?>" style="text-decoration: none;"><button id="botonVer" type="button" class="btn btn-default1">Ver sesion</button></a>
                </td>
              </tr>
            <?php
            }
            ?>
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
      require 'header_entrenador.php'

  ?>

      <body>

        <div class="container">


          <p style="font-size: -webkit-xxx-large;" id="actividades">Sesiones</p>

          <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-striped">

              <thead>

                <tr>
                  <th>Fecha</th>
                  <th>Hora</th>

                  <th>Entrenador</th>
                </tr>

              </thead>

              <tbody>


                <?php
                foreach ($result as $reg) {
                ?>
                  <tr>
                    <td><?php echo date("d-m-Y", strtotime($reg['fecha'])); ?></td>
                    <td><?php echo date("H:i", strtotime($reg['hora'])); ?></td>
                    <td><?php $aux = controlador_usuario::devolverUsuario($reg['Usuario_DNI']);
                        echo ($aux['nombre']);
                        echo (", ");
                        echo ($aux['apellidos']); ?></td>
                    <td>
                      <a href="../vistas/verSesion.php?idSesion=<?php echo $reg['idSesion']; ?>" style="text-decoration: none;"><button id="botonVer" type="button" class="btn btn-default1">Ver sesion</button></a>
                    </td>
                  </tr>
                <?php
                }
                ?>
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
  }
}
?>