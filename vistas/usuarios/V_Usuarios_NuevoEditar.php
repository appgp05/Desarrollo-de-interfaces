<?php
    // echo json_encode($datos);
    $id_Usuario ='';
    $nombre='';
    $apellido_1='';
    $apellido_2='';
    $sexo='H';
    $fecha_Alta=date('Y-m-d');
    $mail='';
    $movil='';
    $login='';
    $pass='';
    $activo='S';
    if(isset($datos['usuario'])){
        extract($datos['usuario']);
        $editar= 'Editar';
    } else {
        $editar= 'Nuevo';
    }

    $cHombre = $sexo=='H' ? ' selected ': '';
    $cMujer = $sexo=='M' ? ' selected ': '';
    $cOtro = $sexo=='O' ? ' selected ': '';
    $cNoLoDigo = $sexo=='P' ? ' checked ': '';
?>
<div class="container-fluid" id="capaEditarCrear">
    <form id="formularioEdicion" name="formularioEdicion">
        <div class="row">
            <?php if($editar=='Editar'):?>
            <div class="form-group col-md-1 col-sm-2 col-xs-3" style="display: none;">
                <label for="">Id</label>
                <input type="text" id="id_Usuario" name="id_Usuario"
                    class="form-control" placeholder="Id" value="<?php echo $id_Usuario; ?>">
            </div>
            <?php endif; ?>    
            <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="">Nombre</label>
                <input type="text" id="nombre" name="nombre"
                    class="form-control" placeholder="Nombre" value="<?php echo $nombre; ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="">Apellido 1</label>
                <input type="text" id="apellido_1" name="apellido_1"
                    class="form-control" placeholder="Apellido 1" value="<?php echo $apellido_1 ?>">
            </div>
            <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="">Apellido 2</label>
                <input type="text" id="apellido_2" name="apellido_2"
                    class="form-control" placeholder="Apellido 2" value="<?php echo $apellido_2 ?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="factivo">Sexo</label>
                <select id="sexo" name="sexo" class="form-control">
                    <option value=""></option>
                    <option value="H" <?php echo $cHombre ?> >Hombre</option>
                    <option value="M" <?php echo $cMujer ?> >Mujer</option>
                    <option value="O" <?php echo $cOtro ?> >Otro</option>
                    <option value="P" <?php echo $cNoLoDigo ?> >Prefiero no contestar</option>
                </select>
            </div>
            <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="">Fecha alta</label>
                <input type="date" id="fecha_Alta" name="fecha_Alta"
                    class="form-control" placeholder="Fecha alta" value="<?php echo $fecha_Alta ?>">
            </div>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label for="">Mail</label>
            <input type="mail" id="mail" name="mail"
                class="form-control" placeholder="Mail" value="<?php echo $mail ?>">
        </div>
        <div class="row">
            <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="">Movil</label>
                <input type="tel" id="movil" name="movil"
                    class="form-control" placeholder="Movil" value="<?php echo $movil ?>">
            </div>
            <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="">Login</label>
                <input type="text" id="login" name="login"
                    class="form-control" placeholder="Login" value="<?php echo $login ?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="">Password</label>
                <input type="password" id="pass" name="pass"
                    class="form-control" placeholder="Password" value="<?php echo $pass ?>">
            </div>
            <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="factivo">Activo</label>
                <select id="activo" name="activo" class="form-control">
                    <option value=""></option>
                    <option value="S" <?php if($activo=='S') echo ' selected '; ?> >Activo</option>
                    <option value="N" <?php if($activo=='N') echo ' selected '; ?> >No activo</option>
                </select>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-lg-12">
            <!-- <?php 
            
            if($editar === 'Nuevo'){
                $SQL = '<button type="button" class="btn btn-outline-success"
                onclick="guardarUsuario()">Guardar</button>';
                echo $SQL;
            } else if ($editar === 'Editar') {
                $SQL = '<button type="button" class="btn btn-outline-success"
                onclick="editarUsuario()">Guardar</button>';
                echo $SQL;
            }

            ?> -->
            <button type="button" class="btn btn-outline-success"
            onclick="guardarUsuario()">Guardar</button>
            <button type="button" class="btn btn-outline-danger"
            onclick="document.getElementById('capaEditarCrear').innerHTML = '';">Cancelar</button>
            <span id="msjError" name="msjError" style="color:blue;"></span>
        </div>
    </div>
</div>