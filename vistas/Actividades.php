<?php
require_once '../funciones/conexion.php';
require_once '../funciones/sesion.php';
require_once '../controladores/controlador_actividad.php';
require 'head.php';
$bd = conexion_BD();
$result = controlador_actividad::getActividades();
?>

<body>

	<?php require 'header_invitado.php'; ?>

	<div class="container">


		<p style="font-size: -webkit-xxx-large;" id="actividades">Actividades</p>


		<div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <table id="tablaActividades" class="table table-striped">
        <thead>
            <tr>
                <th>Nombre Actividad</th>
                <th>Descripción</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $reg) { ?>
                <tr>
                    <td><?php echo $reg['nombre']; ?></td>
                    <td><?php echo $reg['descripcion']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

	</div>


</body>

</html>