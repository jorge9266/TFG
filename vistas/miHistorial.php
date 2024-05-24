<?php
@session_start();


  require 'head.php';
  require_once '../funciones/sesion.php';
  require_once '../controladores/controlador_usuario.php';
  require_once '../controladores/controlador_tabla.php';

  $result = controlador_usuario::getHistorialDeportistas();

  if(isset($_SESSION['userID']) && $_SESSION['userType'] == 'Deportista' && $_SESSION['connected'] == true){
?>

  <body>

  <?php require 'header_deportista.php' ?>

	 <div class="container">
      

      <p style="font-size: -webkit-xxx-large;" id="actividades">Mi Historial de entrenamiento</p>

      <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped">

         <thead> 

            <tr>
              <th><b>Nombre tabla</b></th>
              <th><b>Fecha entrenamiento</b></th>

              <th><b>Ejercicios completados</b></th>


            </tr>



          </thead>
          <form id="eliminar" action="../controladores/controlador_usuario.php?var=6#" method="post">
            <input type="hidden" name="submit" value="submit">
          </form>

          <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
                <a href="modificarDatos.php" style="text-decoration: none;"><button form="eliminar" type="submit" class="btn btn-default2" id="botonAtras"><span  style="margin-right: 5px;"></spanS>Eliminar Historial</button></a>
          </div>

          <tbody>


            <?php
              foreach ($result as $reg) {
            ?>

            <tr>
              <?php $aux=controlador_tabla::devolverDatosTabla($reg["Tabla_IDTabla"]); ?>
			   <td><?php echo $aux['nombre'];?></td>

              <td><?php echo date("d-m-Y H:i:s",strtotime($reg['Fecha'])); ?></td>

             

              <td><?php echo $reg['NEjercicios']; ?></td>
			  </tr>

			  </body>
</html>
			  <?php

            }
          }
  else
  {

    if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador')
    {
    echo "<script>";
    echo "alert('No tienes permisos para entrar en esta pagina');";
    echo "window.location = '../vistas/administrador.php'";
    echo "</script>";
    exit();

    } else{
      if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador')
      {

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
