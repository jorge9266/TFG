<?php
@session_start();

require_once '../funciones/conexion.php';
require_once '../funciones/sesion.php';
require_once '../controladores/controlador_usuario.php';
require 'head.php';
$bd = conexion_BD();
$result = controlador_usuario::devolverUsuario($_SESSION['userID']);

if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista') {
?>

	<body>

		<?php require 'header_deportista.php' ?>

		<div class="container">
			<div id="instalaciones">
				<h1 class="text-center">Bienvenido a GymFit</h1>

				<div id="localizacion">
					<h1 class="text-center">Localización</h1>
					<p class="text-center">C. Lanuza, 1, Distrito Centro, 29009 Málaga</p>
					<div class="d-flex justify-content-center">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3198.007292212622!2d-4.43676331152704!3d36.72238610059262!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd72f7a26901586d%3A0x22fa7564c9b0281d!2sC.%20Lanuza%2C%201%2C%20Distrito%20Centro%2C%2029009%20M%C3%A1laga!5e0!3m2!1ses!2ses!4v1716462232521!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>

				<div id="contacto">
					<div class="row">
						<div class="col-md-6">
							<h2>Contacto:</h2>
							<p>C. Lanuza, 1, Distrito Centro<br>
								29009 Málaga<br>
								Teléfono: 952 000 000<br>
								Email: info@gymfit.es<br>
							</p>
						</div>
						<div class="col-md-6">
							<h2>Horarios:</h2>
							<p>De lunes a viernes: 07:00 - 23:00<br>
								Domingos: 10:00 - 15:00<br>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>

	</html>


<?php
} else {

	if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador') {
		echo "<script>";
		echo "alert('No tienes permisos para entrar en esta pagina');";
		echo "window.location = '../vistas/administrador.php'";
		echo "</script>";
		exit();
	} else {
		if (isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador') {

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