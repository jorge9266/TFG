<?php
session_start();
    unset($_SESSION["userID"]);
    unset($_SESSION["connected"]);

    session_destroy();
	header("Location: ../vistas/principal.php");
	?>