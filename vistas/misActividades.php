<?php
@session_start();

if (isset($_SESSION['userID']) && $_SESSION['userType'] == 'Deportista' && $_SESSION['connected'] == true) {

  require_once '../funciones/conexion.php';
  require_once '../funciones/sesion.php';
  require_once '../controladores/controlador_inscripcion.php';
  require_once '../controladores/controlador_actividad.php';
  require 'head.php';
  
  $bd = conexion_BD();
  $result = controlador_inscripcion::getMisActividades();
?>



  <body>

    <?php require 'header_deportista.php'; ?>

    <div class="container">
      

      <p style="font-size: -webkit-xxx-large;" id="actividades">Mis Actividades</p>

      <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped">

          <thead> 

            <tr>
              <th>ID Actividad</th>
              <th>Nombre Actividad</th>
            </tr>

          </thead>

          <tbody>


            <?php

            foreach ($result as $reg) { 

            ?>




              <tr>
                <td><?php echo $reg['Actividad_idActividad']; ?></td>

                <?php $aux = controlador_actividad::devolverActividad($reg['Actividad_idActividad']); ?>

                <td><?php echo $aux['nombre'] ?></td>
                <td>
                  <a href="verActividadDeportista.php?id=<?php echo $reg['Actividad_idActividad']; ?>" style="text-decoration: none;"><button id="botonVer" type="button" class="btn btn-default2">Ver Actividad</button></a>
                </td>


                <td>
                  <a href="sesionesActividad.php?id=<?php echo $reg['Actividad_idActividad']; ?>" style="text-decoration: none;"><button id="botonGuardarCambios" type="button" class="btn btn-default2">Ver Sesiones</button></a>
                </td>
                
			  <td>
                <a href="misReservas.php?id=<?php echo $reg['Actividad_idActividad']; ?>" style="text-decoration: none;"><button id="botoVer" type="button" class="btn btn-default2" >Mis reservas</button></a>
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