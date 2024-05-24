<?php
@session_start();

require_once '../funciones/conexion.php';
require_once '../controladores/controlador_tabla.php';
require 'head.php';
$bd = conexion_BD();
$result = controlador_tabla::getTablas();
if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador') {
?>




  <body>

    <?php require 'header_entrenador.php' ?>


    <div class="container">


      <h1 class="text-center" style="font-size: 36px; margin-bottom: 20px;">Tablas</h1>

      <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 mb-3">
          <a href="publicarTabla.php" style="text-decoration: none;">
            <button type="button" class="btn btn-primary btn-block">Crear Tabla</button>
          </a>
        </div>
      </div>


      <div class="table-responsive">
        <table class="table table-striped">

          <thead>

            <tr>
              <th>Nombre tabla</th>
              <th>Acciones</th>
            </tr>

          </thead>

          <tbody>
            <?php

            foreach ($result as $reg) {

            ?>
              <tr>
                <td><?php echo $reg['nombre']; ?></td>

                <td>
                  <div class="btn-group" role="group">
                    <a href="verTabla.php?id=<?php echo $reg['idTabla']; ?>" style="text-decoration: none;">
                      <button type="button" class="btn btn-secondary mr-2">Ver Tabla</button>
                    </a>
                    <a href="asignarTabla.php?id=<?php echo $reg['idTabla']; ?>" style="text-decoration: none;">
                      <button type="button" class="btn btn-secondary mr-2">Asignar Tabla General</button>
                    </a>
                    <a href="modificarTabla.php?id=<?php echo $reg['idTabla']; ?>" style="text-decoration: none;">
                      <button type="button" class="btn btn-secondary mr-2">Modificar Tabla</button>
                    </a>
                    <form action="../controladores/controlador_tabla.php?var=1#" method="post">
                      <input type="hidden" name="idTabla" value="<?php echo $reg['idTabla']; ?>">
                      <input type="hidden" name="submit" value="true">
                      <button type="submit" class="btn btn-danger">Eliminar Tabla</button>
                    </form>
                  </div>
                </td>
              </tr>

            <?php }

            ?>
          </tbody>

        </table>
      </div>

    </div>

  </body>

  </html>

<?php
} else {

  if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {
    echo "<script>";
    echo "alert('No tienes permisos para entrar en esta pagina');";
    echo "window.location = '../vistas/administrador.php'";
    echo "</script>";
    exit();
  } else {
    if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista') {

      echo "<script>";
      echo "alert('No tienes permisos para entrar en esta pagina');";
      echo "window.location = '../vistas/deportista.php'";
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
