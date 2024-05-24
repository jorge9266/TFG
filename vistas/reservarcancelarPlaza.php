<?php require 'head.php'; ?>

<body>
	<header>
		
		<nav class="navbar navbar-default1">
			<div class="container-fluid">
				
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"><img src="../images/logo.png" style="margin-top:-10px;"></img></a>
				</div>

				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="margin-top: 3px;">
					<ul class="nav navbar-nav">
						<li><a href="../vistas/deportista.php">Principal</a></li>
						<li><a href="../vistas/gestionarActividades.php">Actividades</a></li>
						<li><a href="../vistas/misActividades.php">Mis actividades</a></li>
						<li><a href="../vistas/misTablas.php">Mis tablas</a></li>
						<li><a href="../vistas/miHistorial.php">Mi Historial</a></li>
						<li><a href="../vistas/verPerfil.php" id="botonPerfil"><span class="glyphicon glyphicon-user" aria-hidden="true" style="margin-right: 5px;"></span>Ver Perfil</a></li>
					</ul>

					 
					<ul class="nav navbar-nav navbar-right">
						<div class="form-group">
							<button id="modalButton" type="button" class="btn btn-default1" data-toggle="modal" data-target=".bs-example-modal-sm" style="margin-left: 10px;">Cerrar Sesi&oacuten</button>
							<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
								<div class="modal-dialog modal-sm" role="document">
									<div class="modal-content" id="modalLogin">
										<div class="modal-header">
											<h4 style="text-align: center; color:white;" class="modal-title">Cerrar Sesi&oacuten</h4>
										</div>
										<div class="text-center">
											<p style="text-align: center; margin-top: 20px;"><img src="../images/logo-grande.png"></img></p>
											<button type="submit" class="btn btn-default1" id="botonModificar" style="margin-bottom: 10px;" value="Confirmar" onclick="location='../funciones/cerrar.php'">Cerrar Sesi&oacuten</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</ul>


		</nav>

	</header>
	<div class="flex_column one_fourth col-xs-12  col-sm-5  col-md-5  col-lg-5">
		<div id="text-4" class="widget widget_text">
			<h3 class="widgettitle">
				<span class="widget_first" style="font-size: larger;">SESIONES:</span>
			</h3>
			<div class="textwidget">
				Lunes:<br>
				<li>10:00 - 11:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				<li>11:00 - 12:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				<li>16:00 - 17:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				<li>17:00 - 18:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				Martes:<br>
				<li>10:00 - 11:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				<li>11:00 - 12:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				<li>16:00 - 17:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				<li>17:00 - 18:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				Miercoles:<br>
				<li>10:00 - 11:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				<li>11:00 - 12:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				<li>16:00 - 17:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				<li>17:00 - 18:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				Jueves:<br>
				<li>10:00 - 11:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				<li>11:00 - 12:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				<li>16:00 - 17:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				<li>17:00 - 18:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				Viernes:<br>
				<li>10:00 - 11:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				<li>11:00 - 12:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				<li>16:00 - 17:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>
				<li>17:00 - 18:00 <input type="button" value="Reservar sesión">
					<input type="button" value="Cancelar sesión">
				</li>

			</div>
			<span class="seperator extralight-border"></span>
		</div>
	</div>

	</div>

</body>

</html>