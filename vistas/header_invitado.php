<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="navbar-header col-xs-4">
                <a class="navbar-brand" href="principal.php">
                    <img src="../images/logo.png" alt="Logo" style="margin-top: -10px;">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../vistas/Actividades.php">Actividades</a>
                    </li>
                </ul>
            </div>

            <div class="col-xs-4">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Iniciar Sesión</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title text-center">Iniciar Sesión</h4>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="login-form-1" style="margin-top: 20px;">
                            <form action="../controladores/controlador_usuario.php?var=3#" method="post">
                                <div class="form-group">
                                    <label for="dni">DNI:</label>
                                    <input name="dni" type="text" id="dni" class="form-control" placeholder="Ingresa DNI" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label for="contrasena">Contraseña:</label>
                                    <input name="contrasena" type="password" id="contrasena" class="form-control" placeholder="Ingresa contraseña" required>
                                </div>
                                <div class="form-group">
                                    <label for="tipo">Tipo:</label>
                                    <select id="tipo" name="tipo" class="form-control" required>
                                        <option>Deportista</option>
                                        <option>Entrenador</option>
                                        <option>Administrador</option>
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-default btn-block" id="botonModificar" name="submit" value="Iniciar Sesión" style="margin-bottom: 10px;">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>