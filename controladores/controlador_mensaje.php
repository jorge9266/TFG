<?php
session_start();
ini_set('display_errors', 1);
include('../funciones/conexion.php');

$idEjercicio = isset($_POST['idEjercicio']) ? $_POST['idEjercicio'] : null;
$comentario = isset($_POST['comentario']) ? $_POST['comentario'] : null;
$idUsuario = isset($_SESSION['ID']) ? $_SESSION['ID'] : null;
$idTabla = isset($_POST['idTabla']) ? $_POST['idTabla'] : null;
echo $idUsuario;
echo $idEjercicio;
function añadirComentarioEjercicio($idEjercicio, $idUsuario, $comentario, $idTabla)
{
    try {
        $bd = conexion_BD();
        $checkStmt = $bd->prepare("SELECT COUNT(*) FROM comenta_ejercicio WHERE Ejercicio_IdEjercicio = ? AND Usuario_ID = ?");
        if ($checkStmt === false) {
            die("Prepare failed: " . $bd->error);
        }
        if (!$checkStmt->bind_param('ii', $idEjercicio, $idUsuario)) {
            die("Bind param failed: " . $checkStmt->error);
        }
        if (!$checkStmt->execute()) {
            die("Execute failed: " . $checkStmt->error);
        }

        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            $stmt = $bd->prepare("UPDATE comenta_ejercicio SET comentario = ? WHERE Ejercicio_IdEjercicio = ? AND Usuario_ID = ?");
            if ($stmt === false) {
                die("Prepare failed: " . $bd->error);
            }
            if (!$stmt->bind_param('sii', $comentario, $idEjercicio, $idUsuario)) {
                die("Bind param failed: " . $stmt->error);
            }
        } else {
            $stmt = $bd->prepare("INSERT INTO comenta_ejercicio (Ejercicio_IdEjercicio, comentario, Usuario_ID) VALUES (?, ?, ?)");
            if ($stmt === false) {
                die("Prepare failed: " . $bd->error);
            }
            if (!$stmt->bind_param('isi', $idEjercicio, $comentario, $idUsuario)) {
                die("Bind param failed: " . $stmt->error);
            }
        }
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
        $bd->close();
        if ($affectedRows > 0) {
            $mensaje = "Comentario Realizado";
        } else {
            $mensaje = "Error al realizar los cambios.";
        }

        echo "<script>";
        echo "alert('$mensaje');";
        echo "window.location = '../vistas/verTablaDeportista.php?id=$idTabla';";
        echo "</script>";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
$idEjercicio = $_POST['idEjercicio'];
$comentario = $_POST['comentario'];
$idUsuario = $_SESSION['ID'];
$idTabla = $_POST['idTabla'];

añadirComentarioEjercicio($idEjercicio, $idUsuario, $comentario, $idTabla);
