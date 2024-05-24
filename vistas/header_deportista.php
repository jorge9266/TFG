<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="principal.php">
                <img src="../images/logo.png" alt="Logo" height="30">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../vistas/deportista.php">Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../vistas/gestionarActividades.php">Actividades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../vistas/misActividades.php">Mis actividades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../vistas/misTablas.php">Mis tablas</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../vistas/verPerfil.php">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Ver Perfil
                        </a>
                    </li>
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
