<?php
    @session_start();
    require 'head.php';
    require_once ('../controladores/controlador_tabla.php');
    require_once ('../controladores/controlador_ejercicio.php');
    require_once ('../controladores/controlador_usuario.php');

    $dni=$_SESSION['userID'];
  
    $db= conexion_BD();
    $idTabla = $_GET['id'];
    $tabla = controlador_tabla::getTabla($idTabla);
    $resultado = controlador_tabla::devolverDatosEjercicioTabla($idTabla);
    
    
     if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista')
      {
?>
  <body>

  <?php require 'header_deportista.php'; ?>

    <div class="container">
      
      <p style="font-size: -webkit-xxx-large;" id="actividades">Datos Tabla</p>



       <div class="row" >
       <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-4">

       <?php
       if($tabla!=null){
          foreach ($tabla as $reg) {
      ?>

         <div>
          <br />
          <label for="nombre" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Nombre Tabla: <?php echo $reg['nombre']; ?></p></label>
          <br />
        </div>

		   <div>
          <br />
          <label for="tipo" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Tipo Tabla: <?php echo $reg['tipo']; ?></p></label>
          <br />
        </div>

        <div>
          <br />
          <label for="instrucciones" style="margin-right:5px; font-weight:normal; font-size: x-large;">Instrucciones:</label><br />
          <textarea name="instrucciones" rows="7" cols="34"  required="" readonly><?php echo $reg['instrucciones']; ?></textarea><br />
        </div>

      </div>
      <?php
        }
      }
      ?>
        <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
		    <label style="margin-right:5px; font-weight:normal; font-size: x-large;">Lista de ejercicios:</label><br />

        <form id="complete" action="../controladores/controlador_ejercicio.php?var=3&idTabla=<?php echo $idTabla; ?>#" method="post">
      <?php
      if($tabla!=null){
        foreach ($resultado as $reg2) {
          ?>


        	 <p><label for="ejercicios" style="font-weight:normal;">Ejercicio: <?php echo($reg2['nombre']); ?></label></p>

            <?php
            if($reg2['tipo']=='cardio'){
            ?>

            <p><label for="tiempo" style="font-weight:normal;">Tiempo: <?php echo($reg2['tiempo']); ?></label></p>

            <?php
             }else if($reg2['tipo']=='resistencia'){
            ?>

            <p><label for="tiempo" style="font-weight:normal;">Tiempo: <?php echo($reg2['tiempo']); ?></label></p>
            <p><label for="peso" style="font-weight:normal;">Peso: <?php echo($reg2['peso']); ?></label></p>

            <?php
              }else{
            ?>

            <p><label for="repeticiones" style="font-weight:normal;">Repeticiones: <?php echo($reg2['repeticiones']); ?></label></p>
            <p><label for="peso" style="font-weight:normal;">Peso: <?php echo($reg2['peso']); ?></label></p>

            <?php
              }
            ?>
           
          
                   <?php echo "<div  style=\"margin-top:30px;\">";
                   echo "<img alt=\"Imagen\" src=\""."../images/ejercicios/".$reg2['URLImagen']."\" style=\"max-width: 70%;\">";?>
              <br>
                  <input name="completados[]" type="checkbox" id="completados[]" value="<?php echo($reg2['idEjercicio']); ?>" autofocus="">
                  <option> Completado</Option>
                  <i>Número de veces realizado: <?php echo(controlador_ejercicio::getVecesEjercicio($reg2['idEjercicio'])); ?> </i>
              <br>
              <br>
                <?php 
                  $res2 = controlador_usuario::getComentarios($reg2['idEjercicio'],$dni);
                  if ($res2!=null) {
                    foreach ($res2 as $reg3) {
                ?>
                 <textarea style="margin-left: 10px;" readonly rows="5" cols="40"><?php echo $reg3['comentario'] ?></textarea>
              <br>
             
                <?php 
                      }
                    }
                ?>
          </div>

    
          <br>
          <br>
          <br>

          <?php
          } echo "</div>"; }
          ?>

          <input type="hidden" name="submit" value="submit">

        </form>

         <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
         <div style="border: solid;border-radius:5px; border-color: black;">
          <form action="../controladores/controlador_usuario.php?var=7" method="post">

                
               <div>
                    <br>
                   <label for="coment" style="margin-left: 10px;"> Añadir Comentario: </label>
                  

                    <select name="idEjercicio">
                     <?php
                    if($tabla!=null){
                      foreach ($resultado as $reg4) {
                   ?>
                        <option value="<?php echo $reg4['idEjercicio'];?>"><?php echo $reg4['nombre']; ?></option>
                    <?php
                      }
                    }
                   ?>
                    </select>
                  

                  <br>
                   <br>

                   <textarea style="margin-left: 10px;" required="" rows="10" cols="40" maxlength="500" name="comentario" placeholder="Comentar ejercicio"></textarea>

                   <br>
                   <br>

                   <input type="hidden" name="idTabla" value="<?php echo $idTabla;?>">
                   <input type="hidden" name="dni" value="<?php echo $dni;?>">
                   <button type="submit" id="botonGuardarCambios" name="submit" class="btn btn-default2" style="margin-left: 10px; margin-bottom: 5px;">Guardar Comentario</button>

                   <br>
                   <br>
               </div>
            
              
          </form>
         </div> 
         <br>
         <br>
         </div>

         

        <div class="btn-group col-xs-12 col-sm-2 col-md-2 col-lg-2">
          <a href="misTablas.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonAtras"><span class="glyphicon glyphicon-step-backward" style="margin-right: 5px;"></span>Atr&aacutes</button></a>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

		    <div class="btn-group col-xs-12 col-sm-2 col-md-2 col-lg-2">
          <button form="complete" type="submit" class="btn btn-default2" id="botonAtras"><span  style="margin-right: 5px;"></span>Tabla completada </button>
        </div>

   </div>

  </div>



  </body>

</html>

<?php
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
