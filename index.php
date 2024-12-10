<?php session_start();
    if($_SESSION['usuario']){

    } else {
        header('Location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="stylesheet" href="./librerias/bootstrap-5.3.3/dist/css/bootstrap.min.css">
        <script src="librerias/bootstrap-5.3.3/dist/js/bootstrap.bundle.js"></script>
        <link rel="stylesheet" href="css/app.css">
    </head>
    <body>
        <div class="container-fluid" id="capaEncabezado">
            <div class="row">
                <div class="col-md-2 col-sm-9 d-none d-sm-block">
                    <img src="iconos/logo.png" style="height: 5rem;">
                </div>
                <div class="col-md-8 d-none d-md-block divTitulo">
                    Alberto Puig - DI 2024
                </div>
                <div class="col-md-2 col-sm-3 d-none d-sm-block">
                    login
                    <?php echo $_SESSION['usuario']; ?>
                </div>
            </div>
        </div>
        <?php
        
        require_once 'controladores/C_Menu.php';
        $menuController = new C_Menu;
        $menu = $menuController->renderMenu();

        ?>
        <!-- <div class="container-fluid" id="capaMenu">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown link
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" onclick="obtenerVista('Usuarios', 'getVistaFiltros', 'capaContenido')">Usuarios</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
        </div> -->
        <div class="container-fluid" id="capaContenido">
        </div>
        <script src="app.js" async></script>
    </body>
</html>