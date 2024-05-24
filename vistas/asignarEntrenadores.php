<?php
@session_start();

require_once '../funciones/conexion.php';
require_once '../controladores/controlador_usuario.php';
require 'head.php';

if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {

    require 'header_admin.php';

?>

    <div class="container">
        <h1 class="display-4">Asignar Entrenador a Deportista</h1>

        <form id="asignar_form" action="../controladores/controlador_usuario.php?var=8#" method="post" onsubmit="return valida(this)" enctype="multipart/form-data" style="margin-right:5px;">
            <div class="form-group">
                <label for="entrenador">Entrenador:</label>
                <select id="entrenador" name="entrenador" class="form-control" required>
                    <?php
                    $entrenadores = controlador_usuario::getEntrenadores();
                    foreach ($entrenadores as $entrenador) {
                        echo "<option value='" . $entrenador['ID'] . "'>" . $entrenador['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="deportista">Deportista:</label>
                <select name="deportista" class="form-control" required>
                    <?php
                    $deportistas = controlador_usuario::getDeportistas();
                    foreach ($deportistas as $deportista) {
                        echo "<option value='" . $deportista['ID'] . "'>" . $deportista['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <input type="hidden" name="actualizardni" value="<?php echo isset($result['DNI']) ? $result['DNI'] : ''; ?>">

            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-ok"></span> Guardar Cambios
                    </button>
                </div>
                <div class="col-md-6">
                    <a href="gestionarUsuarios.php" class="btn btn-danger">
                        Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>

    </body>

    </html>

<?php
} else {

    if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista') {
        echo "<script>";
        echo "alert('No tienes permisos para entrar en esta página');";
        echo "window.location = '../vistas/deportista.php'";
        echo "</script>";
        exit();
    } else {
        if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador') {

            echo "<script>";
            echo "alert('No tienes permisos para entrar en esta página');";
            echo "window.location = '../vistas/entrenador.php'";
            echo "</script>";
            exit();
        } else {

            echo "<script>";
            echo "alert('No tienes permisos para entrar en esta página');";
            echo "window.location = '../vistas/principal.php'";
            echo "</script>";
            exit();
        }
    }
}
?>