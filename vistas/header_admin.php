<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="principal.php">
                <img src="../images/logo.png" alt="Logo" height="30" style="margin-top: -10px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../vistas/administrador.php">Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../vistas/gestionarUsuarios.php">Gestión de usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../vistas/gestionarActividades.php">Gestión de actividades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../vistas/gestionarEjercicios.php">Gestión de ejercicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../vistas/verPerfil.php">Ver Perfil</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <form action="../funciones/cerrar.php">
                            <button type="submit" class="btn btn-outline-light">Cerrar Sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>