<?php
    session_start();
    unset($_SESSION['login']);
    unset($_SESSION['usuario']);
    unset($_SESSION['id_Usuario']);

    require_once 'controladores/C_Menu.php';
    $controladorMenu = new C_Menu();

    $_SESSION['permisosSesion'] = [];

    $permisosVisitanteSesion = $controladorMenu->getPermisosVisitanteSesion();
    foreach($permisosVisitanteSesion as $permiso){
        $_SESSION['permisosSesion'][] = $controladorMenu->obtenerPermisosRol($permiso['id_Permiso'])[0];
    }

    header('Location: index.php');
?>