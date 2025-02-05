<?php session_start();
    $usuario='';
    $pass='';
    extract($_POST);
    // echo "user: ".$usuario." pass: ".$pass;
    $msj='';

    if($usuario=='' || $pass==''){
        // $msj='Debes completar los campos';
    } else {
        require_once 'controladores/C_Usuarios.php';
        $objCont = new C_Usuarios();
        $id_Usuario=$objCont->validarUsuario(array('usuario'=>$usuario, 'pass'=>$pass));

        if($id_Usuario!=''){
            $_SESSION['usuario']=$usuario;

            require_once 'controladores/C_Menu.php';
            $controladorMenu = new C_Menu();
    
            $permisosUsuarioSesion = $controladorMenu->getPermisosUsuarioSesion(array('id'=>$id_Usuario));

            $_SESSION['permisosSesion']=$permisosUsuarioSesion;

            //Saltar a ésta página (No puede haber pintado nada antes)
            header('Location: index.php');
        } else {
            unset($_SESSION['login']);
            unset($_SESSION['id_Usuario']);
            $msj='No es correcto.';
        }
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
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card p-4 shadow">
        <h3 class="text-center">Iniciar Sesión</h3>
        <label for="formularioLogin">Por favor, rellene los campos necesarios para iniciar sesión</label>
        
        <form id="formularioLogin" name="formularioLogin" method="post" action="login.php">
            <div class="form-group">
                <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Login" value="<?php echo $usuario ?>" required>
            </div>
            <div class="form-group">
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" value="<?php echo $pass ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <span id="msj" class="msj"><?php echo $msj; ?></span>
        </form>
    </div>
</div>
    </body>
</html>