<?php
@session_start();
require_once('../controladores/controlador_ejercicio.php');
require 'head.php';

if (isset($_SESSION['userID']) && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador') {
?>

  <body>

    <?php require 'header_entrenador.php'; ?>

    <div class="container">

      <h1 class="display-4 mt-5 mb-4">Nuevo ejercicio</h1>

      <form id="contact_form" action="../controladores/controlador_ejercicio.php?var=0#" method="post" enctype="multipart/form-data">

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="ejercicio" class="control-label">ID Ejercicio:</label>
              <input placeholder="Introduce el ID del ejercicio" name="ejercicio" type="text" class="form-control" required="">
            </div>
            <div class="form-group">
              <label for="nombreEjercicio" class="control-label">Nombre Ejercicio:</label>
              <input placeholder="Introduce el nombre del ejercicio" name="nombreEjercicio" type="text" class="form-control" required="">
            </div>
            <div class="form-group">
              <label for="descripcion" class="control-label">Descripción:</label>
              <textarea name="descripcion" rows="7" class="form-control" required=""></textarea>
            </div>
            <div class="form-group">
              <label for="repeticiones" class="control-label">Repeticiones:</label>
              <input type="text" name="repeticiones" placeholder="xx-xx-xx-xx" class="form-control">
            </div>
            <div class="form-group">
              <label for="peso" class="control-label">Peso:</label>
              <input type="number" min="0" name="peso" class="form-control">
            </div>
            <div class="form-group">
              <label for="tiempo" class="control-label">Tiempo:</label>
              <input type="text" name="tiempo" class="form-control">
            </div>
            <div class="form-group">
              <label for="imgEjer" class="control-label">Subir Imagen:</label>
              <input type="file" name="imagen" class="form-control" required="">
            </div>
            <div class="form-group">
              <label for="tipo" class="control-label">Tipo:</label>
              <select name="tipo" class="form-control">
                <option value="brazos">Brazos</option>
                <option value="espalda">Espalda</option>
                <option value="pecho">Pecho</option>
                <option value="piernas">Piernas</option>
                <option value="cardio">Cardio</option>
                <option value="resistencia">Resistencia</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <button type="submit" id="submit" name="submit" class="btn btn-success btn-lg">
              <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Publicar Ejercicio
            </button>
          </div>
          <div class="col-md-6">
            <a href="gestionarEjercicios.php" class="btn btn-danger btn-lg">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
            </a>
          </div>
        </div>

      </form>

    </div>

  </body>

  </html>

  <?php
} else {

  if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {   ?>


    <body>

      <?php require 'header_admin.php' ?>

      <div class="container">

        <h1 class="display-3">Nuevo Ejercicio</h1>

        <form id="contact_form" action="../controladores/controlador_ejercicio.php?var=0#" method="post" enctype="multipart/form-data" style="margin-right:5px;">

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="ejercicio">ID Ejercicio:</label>
                <input placeholder="Introduce el ID del ejercicio" name="ejercicio" type="text" class="form-control" required="">
              </div>
              <div class="form-group">
                <label for="nombreEjercicio">Nombre Ejercicio:</label>
                <input placeholder="Introduce el nombre del ejercicio" name="nombreEjercicio" type="text" class="form-control" required="">
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" rows="7" class="form-control" required=""></textarea>
              </div>
              <div class="form-group">
                <label for="repeticiones">Repeticiones:</label>
                <input type="text" name="repeticiones" placeholder="xx-xx-xx-xx" class="form-control">
              </div>
              <div class="form-group">
                <label for="peso">Peso:</label>
                <input type="number" min="0" name="peso" class="form-control">
              </div>
              <div class="form-group">
                <label for="tiempo">Tiempo:</label>
                <input type="text" name="tiempo" class="form-control">
              </div>
              <div class="form-group">
                <label for="imgEjer">Subir Imagen:</label>
                <input type="file" name="imagen" class="form-control" required="">
              </div>
              <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select name="tipo" class="form-control">
                  <option value="brazos">Brazos</option>
                  <option value="espalda">Espalda</option>
                  <option value="pecho">Pecho</option>
                  <option value="piernas">Piernas</option>
                  <option value="cardio">Cardio</option>
                  <option value="resistencia">Resistencia</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <button type="submit" id="submit" name="submit" class="btn btn-success btn-lg">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Publicar Ejercicio
              </button>
              <a href="gestionarEjercicios.php" class="btn btn-danger btn-lg">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
              </a>
            </div>
          </div>
        </form>
      </div>
    </body>

    </html>

<?php

  } else {
    if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista') {

      echo "<script>";
      echo "alert('No tienes permisos para entrar en esta pagina');";
      echo "window.location = '../vistas/deportista.php'";
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