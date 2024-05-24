<?php
@session_start();
require_once('../controladores/controlador_usuario.php');
require 'head.php';
if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php require 'head.php'; ?>
    <script type="text/javascript">
        function valida(f) {
            var ok = true;
            var msg = "";
            var auxN = false;
            var auxE = false;

            emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
            dniN = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i;
            dniE = /^[XYZ]{1}[0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i;

            if (!(emailRegex.test(f.elements["correo"].value))) {
                msg += "La dirección de correo electrónico no parece válida.";
                ok = false;
            }

            if (!(dniN.test(f.elements["dni"].value)))
                auxN = true;

            if (!(dniE.test(f.elements["dni"].value)))
                auxE = true;

            if (auxN || AuxE) {
                msg += "El DNI no parece correcto.";
                ok = false;
            }

            if (ok == false)
                alert(msg);
            return ok;
        }
    </script>
</head>

<body>

    <?php require 'header_admin.php' ?>

    <div class="container">
        <h1 class="text-center" id="actividades">Nuevo Usuario</h1>
        <form id="contact_form" action="../controladores/controlador_usuario.php?var=0#" method="post" onsubmit="return valida(this)" enctype="multipart/form-data">

            <div class="form-group">
                <label for="dni">DNI:</label>
                <input placeholder="Introduce el DNI del Usuario" id="dni" name="dni" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="usuario">Nombre:</label>
                <input placeholder="Introduce el Nombre" name="usuario" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input placeholder="Introduce los Apellidos" name="apellidos" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input placeholder="Introduce el Email" id="correo" name="email" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" placeholder="Introduce la Contraseña" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo Usuario:</label>
                <select id="tipo" name="tipo" class="form-control" required>
                    <option value="Deportista">Deportista</option>
                    <option value="Entrenador">Entrenador</option>
                    <option value="Administrador">Administrador</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <button type="submit" id="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Guardar Usuario</button>
                </div>
                <div class="col-md-6">
                    <a href="gestionarUsuarios.php" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </form>
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
