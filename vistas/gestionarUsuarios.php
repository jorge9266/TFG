<?php
@session_start();

require 'head.php';
require_once '../funciones/conexion.php';
require_once '../controladores/controlador_usuario.php';
$bd = conexion_BD();
$result = controlador_usuario::getUsuarios();
if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php require 'head.php'; ?>
</head>

<body>

    <?php require 'header_admin.php' ?>

    <div class="container">
        <h1 class="display-4 mt-5 mb-4">Usuarios</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="btn-group" role="group">
                    <a href="altaUsuario.php" class="btn btn-outline-dark">Crear Usuario</a>
                    <a href="asignarEntrenadores.php" class="btn btn-outline-dark">Asignar Entrenadores</a>
                </div>
            </div>
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $reg) : ?>
                        <tr>
                            <td><?php echo $reg['nombre'] . ' ' . $reg['apellidos']; ?></td>
                            <td>
                                <a href="modificarUsuario.php?id=<?php echo $reg['DNI']; ?>" class="btn btn-outline-dark">
                                    <span class="glyphicon glyphicon-floppy-open" aria-hidden="true"></span> Modificar Usuario
                                </a>
                                <form action="../controladores/controlador_usuario.php?var=1#" method="post">
                                    <input type="hidden" name="dni" value="<?php echo $reg['DNI']; ?>">
                                    <input type="hidden" name="submit" value="true">
                                    <button type="submit" class="btn btn-outline-dark">
                                        <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span> Eliminar Usuario
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>

<?php
} else {
    if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador') {
        echo "<script>";
        echo "alert('No tienes permisos para entrar en esta página');";
        echo "window.location = '../vistas/entrenador.php'";
        echo "</script>";
        exit();
    } else {
        if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista') {
            echo "<script>";
            echo "alert('No tienes permisos para entrar en esta página');";
            echo "window.location = '../vistas/deportista.php'";
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
