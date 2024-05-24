<?php
@session_start();


require 'head.php';
require_once '../funciones/sesion.php';
require_once '../controladores/controlador_tabla.php';
$bd = conexion_BD();
$result = controlador_tabla::getTablasDeportista();



if (isset($_SESSION['userID']) && $_SESSION['userType'] == 'Deportista' && $_SESSION['connected'] == true) {

?>



  <body>

    <?php require 'header_deportista.php'; ?>

    <div class="container">


      <p style="font-size: -webkit-xxx-large;" id="actividades">Mis Tablas</p>

      <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped">

          <thead>

            <tr>
              <th><b>ID tabla</b></th>
              <th><b>Nombre tabla</b></th>
            </tr>

          </thead>

          <tbody>


            <?php
            foreach ($result as $reg) {

            ?>



              <tr>
                <td><?php echo $reg['Tabla_idTabla']; ?></td>
                <?php $aux = controlador_tabla::devolverDatosTabla($reg['Tabla_idTabla']); ?>

                <td><?php echo $aux['nombre'] ?></td>
                <td>
                  <a href="verTablaDeportista.php?id=<?php echo $reg['Tabla_idTabla']; ?>" style="text-decoration: none;"><button id="botonVer" type="button" class="btn btn-default2">Ver Tabla de ejercicios</button></a>
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