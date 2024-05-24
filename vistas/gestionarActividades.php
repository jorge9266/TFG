<?php
@session_start();

require_once '../funciones/conexion.php';
require_once '../funciones/sesion.php';
require_once '../controladores/controlador_actividad.php';
require 'head.php';
$bd = conexion_BD();
$result = controlador_actividad::getActividades();

if (isset($_SESSION['userID']) && $_SESSION['userType'] == 'Administrador' && $_SESSION['connected'] == true) {
?>


  <body>

    <?php require 'header_admin.php' ?>

    <div class="container">


      <h1 class="display-4">Actividades</h1>



      <div class="btn-group mb-3" role="group">
        <a href="publicarActividad.php"><button type="button" class="btn btn-primary">Publicar Actividad</button></a>
      </div>


      <div class="table-responsive">
        <table class="table table-striped">

          <thead>

            <tr>
              <th>Nombre Actividad</th>
              <th>Ver Actividad</th>
              <th>Publicar Sesión</th>
              <th>Ver Sesiones</th>
            </tr>

          </thead>

          <tbody>


            <?php

            foreach ($result as $reg) {

            ?>




              <tr>
                <td><?php echo $reg['nombre']; ?></td>
                <td>
                  <a href="verActividad.php?id=<?php echo $reg['idActividad']; ?>" class="btn btn-primary">Ver Actividad</a>
                </td>

                <td>
                  <a href="altaSesion.php?id=<?php echo $reg['idActividad']; ?>" class="btn btn-success"> Publicar Sesión </a>
                </td>

                <td>
                  <a href="verSesiones.php?id=<?php echo $reg['idActividad']; ?>" class="btn btn-info"> Ver Sesiones </a>
                </td>

              <?php

            }
          } else if (isset($_SESSION['userID']) && $_SESSION['userType'] == 'Deportista' && $_SESSION['connected'] == true) {
              ?>

              <body>

                <?php require 'header_deportista.php'; ?>

                <div class="container">


                  <h1 class="display-4">Actividades</h1>

                  <div class="table-responsive">
                    <table class="table table-striped">

                      <thead>

                        <tr>
                          <th>Nombre Actividad</th>
                          <th>Ver Actividad</th>
                          <th>Inscribirse</th>
                          <th>Cancelar Inscripción</th>
                        </tr>

                      </thead>

                      <tbody>


                        <?php

                        foreach ($result as $reg) {

                        ?>

                          <tr>
                            <td><?php echo $reg['nombre']; ?></td>
                            <td>
                              <a href="verActividadDeportista.php?id=<?php echo $reg['idActividad']; ?>" class="btn btn-primary">Ver Actividad</a>
                            </td>


                            <td>
                              <a href="confirmarInscripcion.php?id=<?php echo $reg['idActividad']; ?>&nombre=<?php echo $reg['nombre']; ?>" class="btn btn-success">Inscribirse</a>
                            </td>

                            <td>
                              <a href="cancelarInscripcion.php?id=<?php echo $reg['idActividad']; ?>&nombre=<?php echo $reg['nombre']; ?>" class="btn btn-danger">Cancelar inscripción</a>
                            </td>
                          </tr>



                        <?php
                        }
                      } else if (isset($_SESSION['userID']) && $_SESSION['userType'] == 'Entrenador' && $_SESSION['connected'] == true) {
                        ?>

                        <body>

                          <?php require 'header_entrenador.php' ?>

                          <div class="container">


                            <h1 class="display-4">Actividades</h1>

                            <div class="table-responsive">
                              <table class="table table-striped">

                                <thead>

                                  <tr>
                                    <th>Nombre Actividad</th>
                                    <th>Ver Actividad</th>
                                    <th>Ver Sesiones</th>
                                  </tr>

                                </thead>

                                <tbody>
                                  <?php

                                  foreach ($result as $reg) {

                                  ?>
                                    <tr>
                                      <td><?php echo $reg['nombre']; ?></td>
                                      <td>
                                        <a href="verActividadEntrenador.php?id=<?php echo $reg['idActividad']; ?>" class="btn btn-primary">Ver Actividad</a>
                                      </td>

                                      <td>
                                        <a href="verSesiones.php?id=<?php echo $reg['idActividad']; ?>" class="btn btn-info"> Ver Sesiones </a>
                                      </td>

                                    </tr>
                                <?php
                                  }
                                } else {

                                  echo "<script>";
                                  echo "alert('No tienes permisos para entrar en esta página');";
                                  echo "window.location = '../vistas/principal.php'";
                                  echo "</script>";
                                  exit();
                                }
                                ?>