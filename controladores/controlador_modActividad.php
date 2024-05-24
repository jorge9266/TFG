<?php
session_start();
ini_set('display_errors', 1);
include('../funciones/conexion.php');

$id = isset($_POST['actualizarid']) ? $_POST['actualizarid'] : null;
$nombre = isset($_POST['actualizarnombre']) ? $_POST['actualizarnombre'] : null;
$tipo = isset($_POST['actualizartipo']) ? $_POST['actualizartipo'] : null;
$des = isset($_POST['actualizardescrip']) ? $_POST['actualizardescrip'] : null;
$lugar = isset($_POST['actualizarlugar']) ? $_POST['actualizarlugar'] : null;

function modificarActividad($id, $nombre, $tipo, $des, $lugar)
{
    try {
        $bd = conexion_BD();
        $stmt = $bd->prepare("UPDATE actividad SET nombre=?, tipo=?, descripcion=?, lugar=? WHERE idActividad=?");
        if ($stmt === false) {
            die("Prepare failed: " . $bd->error);
        }
        if (!$stmt->bind_param("ssssi", $nombre, $tipo, $des, $lugar, $id)) {
            die("Bind param failed: " . $stmt->error);
        }
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
        if ($stmt->affected_rows > 0) {
            $mensaje = 'La actividad ha sido modificada correctamente';
        } else {
            $mensaje = 'Error al modificar la actividad';
        }
        $stmt->close();
        $bd->close();
        return $mensaje;
    } catch (Exception $e) {

        return "Error: " . $e->getMessage();
    }
}

$mensaje = modificarActividad($id, $nombre, $tipo, $des, $lugar);

echo "<script>";
if (strpos($mensaje, 'correctamente') !== false) {
    echo "alert('$mensaje');";
    echo "window.history.back();";
} else {
    echo "alert('$mensaje');";
}
echo "</script>";
