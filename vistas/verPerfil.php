<?php
@session_start();
require 'head.php';

if (isset($_SESSION['userID']) && $_SESSION['connected'] == true) {
    require_once '../funciones/conexion.php';
    require_once '../controladores/controlador_usuario.php';
    $db = conexion_BD();
    $result = controlador_usuario::devolverUsuario($_SESSION['userID']);
    $userType = $_SESSION['userType'];

    switch ($userType) {
        case 'Administrador':
            require 'header_admin.php';
            break;
        case 'Entrenador':
            require 'header_entrenador.php';
            break;
        case 'Deportista':
            require 'header_deportista.php';
            break;
        default:
            echo "<script>alert('No tienes permisos para entrar en esta página');</script>";
            echo "<script>window.location = '../vistas/principal.php';</script>";
            exit();
    }
} else {
    echo "<script>alert('No tienes permisos para entrar en esta página');</script>";
    echo "<script>window.location = '../vistas/principal.php';</script>";
    exit();
}
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <h1 style="font-size: 36px; font-weight: bold; margin-bottom: 20px;">Tus datos:</h1>
                <div class="profile-info">
                    <div class="info-item">
                        <label for="DNI" style="font-size: 18px; font-weight: bold;">DNI:</label>
                        <span><?php echo $result['DNI']; ?></span>
                    </div>
                    <div class="info-item">
                        <label for="nombre" style="font-size: 18px; font-weight: bold;">Nombre:</label>
                        <span><?php echo $result['nombre']; ?></span>
                    </div>
                    <div class="info-item">
                        <label for="apellidos" style="font-size: 18px; font-weight: bold;">Apellidos:</label>
                        <span><?php echo $result['apellidos']; ?></span>
                    </div>
                    <div class="info-item">
                        <label for="email" style="font-size: 18px; font-weight: bold;">Email:</label>
                        <span><?php echo $result['email']; ?></span>
                    </div>
                    <div class="info-item">
                        <label for="password" style="font-size: 18px; font-weight: bold;">Contraseña:</label>
                        <span>****</span>
                    </div>
                    <div class="info-item">
                        <label for="tipo" style="font-size: 18px; font-weight: bold;">Tipo de usuario:</label>
                        <span><?php echo $result['tipo']; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="btn-group" role="group" style="margin-top: 10px; margin-bottom: 15px;">
                    <a href="modificarDatos.php" class="btn btn-primary" style="text-decoration: none;"><span style="margin-right: 5px;"></span>Modificar Datos</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
