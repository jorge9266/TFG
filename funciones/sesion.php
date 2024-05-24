<?php

function iniciarSesion($id, $tipo)  
{
    session_start();
    $bd = conexion_BD();
    $sql = "SELECT ID FROM usuario WHERE DNI = ?";
    $stmt = mysqli_prepare($bd, $sql);
    if (!mysqli_stmt_bind_param($stmt, "i", $id)) {
        die("Parameter binding failed: " . mysqli_stmt_error($stmt));
    }
    if (!mysqli_stmt_execute($stmt)) {
        die("Statement execution failed: " . mysqli_stmt_error($stmt));
    }
    $result = mysqli_stmt_get_result($stmt);
    if (!$result) {
        die("Getting result set failed: " . mysqli_stmt_error($stmt));
    }
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        die("No user found with the given DNI.");
    }

    $ID = $row['ID'];
    $_SESSION['idUsuario'] = $ID;
    $_SESSION['connected'] = true;
    $_SESSION['userID'] = $id;
    $_SESSION['userType'] = $tipo;

    mysqli_stmt_close($stmt);
    mysqli_close($bd);
}

  function cerrarSesion ()      
  {
    session_start();
    unset($_SESSION["userID"]);

    unset($_SESSION["connected"]);

    session_destroy();
	
  }
?>
