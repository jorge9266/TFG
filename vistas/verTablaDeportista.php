<?php
@session_start();

require_once ('../controladores/controlador_tabla.php');
require_once ('../controladores/controlador_ejercicio.php');
require_once ('../controladores/controlador_usuario.php');
require "head.php";

$dni=$_SESSION['userID'];

$db= conexion_BD();
$idTabla = $_GET['id'];
$tabla = controlador_tabla::getTabla($idTabla);
$resultado = controlador_tabla::devolverDatosEjercicioTabla($idTabla);

if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista') {
?>
<?php require "header_deportista.php" ?>

<div class="container">
    <h1 class="display-1" id="actividades">Datos Tabla</h1>

    <div class="row">
        <div class="col-lg-4">
            <?php if($tabla!=null): ?>
                <?php foreach ($tabla as $reg): ?>
                    <div>
                        <br />
                        <label for="nombre"><p class="h3">Nombre Tabla: <?php echo $reg['nombre']; ?></p></label>
                        <br />
                    </div>
                    <div>
                        <br />
                        <label for="tipo"><p class="h3">Tipo Tabla: <?php echo $reg['tipo']; ?></p></label>
                        <br />
                    </div>
                    <div>
                        <br />
                        <label for="instrucciones"><p class="h3">Instrucciones:</p></label><br />
                        <textarea name="instrucciones" rows="7" cols="34"  required="" readonly><?php echo $reg['instrucciones']; ?></textarea><br />
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="col-lg-4">
            <label class="h3">Lista de ejercicios:</label><br />
            <form id="complete" action="../controladores/controlador_ejercicio.php?var=3&idTabla=<?php echo $idTabla; ?>#" method="post">
                <?php if($tabla!=null): ?>
                    <?php foreach ($resultado as $reg2): ?>
                        <div>
                            <label for="ejercicios">Ejercicio: <?php echo $reg2['nombre']; ?></label>
                            <?php if($reg2['tipo']=='cardio'): ?>
                                <label for="tiempo">Tiempo: <?php echo $reg2['tiempo']; ?></label>
                            <?php elseif($reg2['tipo']=='resistencia'): ?>
                                <label for="tiempo">Tiempo: <?php echo $reg2['tiempo']; ?></label>
                                <label for="peso">Peso: <?php echo $reg2['peso']; ?></label>
                            <?php else: ?>
                                <label for="repeticiones">Repeticiones: <?php echo $reg2['repeticiones']; ?></label>
                                <label for="peso">Peso: <?php echo $reg2['peso']; ?></label>
                            <?php endif; ?>
                            <img src="../images/ejercicios/<?php echo $reg2['URLImagen']; ?>" style="max-width: 70%;" alt="Imagen"><br />
                            <h4>Comentario Actual:</h4>
                            <?php $res2 = controlador_usuario::getComentarios($reg2['idEjercicio'],$dni); ?>
                            <?php if($res2!=null): ?>
                                <?php foreach ($res2 as $reg3): ?>
                                    <textarea readonly rows="5" cols="40"><?php echo $reg3['comentario']; ?></textarea>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <input type="hidden" name="submit" value="submit">
            </form>
        </div>

        <div class="col-lg-4">
            <div style="border: solid; border-radius: 5px; border-color: black; padding: 10px;">
                <form action="../controladores/controlador_mensaje.php" method="post">
                    <label for="coment"> Añadir Comentario: </label>
                    <select name="idEjercicio" class="form-select">
                        <?php if($tabla!=null): ?>
                            <?php foreach ($resultado as $reg4): ?>
                                <option value="<?php echo $reg4['idEjercicio'];?>"><?php echo $reg4['nombre']; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <textarea required rows="10" cols="40" maxlength="500" name="comentario" placeholder="Comentar ejercicio"></textarea>
                    <input type="hidden" name="idTabla" value="<?php echo $idTabla;?>">
                    <input type="hidden" name="dni" value="<?php echo $dni;?>">
                    <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Guardar Comentario</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <a href="misTablas.php" class="btn btn-secondary"><span class="glyphicon glyphicon-step-backward"></span> Atrás</a>
        </div>
        <div class="col-lg-2">
            <button form="complete" type="submit" class="btn btn-success">Tabla completada</button>
        </div>
    </div>
</div>

<?php
} else {
    if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {
        echo "<script>";
        echo "alert('No tienes permisos para entrar en esta pagina');";
        echo "window.location = '../vistas/administrador.php'";
        echo "</script>";
        exit();
    } else {
        if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador') {
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
