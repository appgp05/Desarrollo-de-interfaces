<?php
// $id_Usuario ='';
// $nombre='';
// $apellido_1='';
// $apellido_2='';
// $sexo='H';
// $fecha_Alta=date('Y-m-d');
// $mail='';
// $movil='';
// $login='';
// $pass='';
// $activo='S';
    // echo json_encode($datos);
    $id='';
    $titulo='';
    $url='';
    $nivel='0';
    $padre_id='0';
    $orden='0';
    $es_dropdown='';
    $onclick='';
    if(isset($datos['opcionMenu'])){
        extract($datos['opcionMenu']);
        $editar= 'Editar';
    } else {
        $editar= 'Nuevo';
    }

    if(isset($datos['nivel'])){
        $nivel=$datos['nivel'];
        echo "hijo: ".$nivel;
    }
    if(isset($datos['padre_id'])){
        $padre_id=$datos['padre_id'];
        echo "padre_id: ".$padre_id;
    }
    if(isset($datos['orden'])){
        $orden=$datos['orden'];
        echo "orden: ".$orden;
    }

    // echo "aaaa ".$hijo;

    // $cHombre = $sexo=='H' ? ' selected ': '';
    // $cMujer = $sexo=='M' ? ' selected ': '';
    // $cOtro = $sexo=='O' ? ' selected ': '';
    // $cNoLoDigo = $sexo=='P' ? ' checked ': '';
?>
    <form id="formularioEdicion" name="formularioEdicion" style="display:none">
        <div class="row">
            <?php if($editar=='Editar'):?>
            <div class="form-group col-md-1 col-sm-2 col-xs-3" style="display: none;">
                <label for="">Id</label>
                <input type="text" id="id" name="id"
                    class="form-control" placeholder="Id" value="<?php echo $id; ?>">
            </div>
            <?php endif; ?>    
            <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="">Titulo</label>
                <input type="text" id="titulo" name="titulo"
                    class="form-control" placeholder="Titulo" value="<?php echo $titulo; ?>">
            </div>
            <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="">Url</label>
                <input type="text" id="url" name="url"
                    class="form-control" placeholder="Url" value="<?php echo $url ?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="">Nivel</label>
                <input type="text" id="nivel" name="nivel"
                    class="form-control" placeholder="Nivel" value="<?php echo $nivel;  ?>">
            </div>
            <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="">Padre Id</label>
                <input type="text" id="padre_id" name="padre_id"
                    class="form-control" placeholder="Padre Id" value="<?php echo $padre_id ?>">
            </div>
            <div class="form-group col-md-6 col-sm-12">
                <label for="">Orden</label>
                <input type="text" id="orden" name="orden"
                    class="form-control" placeholder="Orden" value="<?php echo $orden ?>">
            </div>
        </div>
        <div class="row">
            <!-- <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="factivo">Sexo</label>
                <select id="sexo" name="sexo" class="form-control">
                    <option value=""></option>
                    <option value="H" <?php echo $cHombre ?> >Hombre</option>
                    <option value="M" <?php echo $cMujer ?> >Mujer</option>
                    <option value="O" <?php echo $cOtro ?> >Otro</option>
                    <option value="P" <?php echo $cNoLoDigo ?> >Prefiero no contestar</option>
                </select>
            </div> -->
            
        </div>
        
        <div class="row">
            <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="">Es dropdown</label>
                <input type="text" id="es_dropdown" name="es_dropdown"
                    class="form-control" placeholder="Es dropdown" value="<?php echo $es_dropdown ?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="">Onclick</label>
                <input type="text" id="onclick" name="onclick"
                    class="form-control" placeholder="Onclick" value="<?php echo $onclick ?>">
            </div>
            <!-- <div class="form-group col-md-3 col-sm-4 col-xs-5">
                <label for="factivo">Activo</label>
                <select id="activo" name="activo" class="form-control">
                    <option value=""></option>
                    <option value="S" <?php if($activo=='S') echo ' selected '; ?> >Activo</option>
                    <option value="N" <?php if($activo=='N') echo ' selected '; ?> >No activo</option>
                </select>
            </div> -->
        </div>
    </form>
    <div class="row" style="display:none">
        <div class="col-lg-12">
            <?php 
                // echo "<p>".$editar."</p>";
                // if($editar === 'Nuevo'){
                //     $SQL = '<button type="button" class="btn btn-outline-success"
                //     onclick="guardarUsuario()">Guardar</button>';
                //     echo $editar."SDJFKDLFG";
                //     echo $SQL;
                // } else if ($editar === 'Editar') {
                //     $SQL = '<button type="button" class="btn btn-outline-success"
                //     onclick="editarUsuario()">Guardar</button>';
                //     echo $editar."DSKJFHJSDGFDF";
                //     echo $SQL;
                // }
            ?>
            <button type="button" class="btn btn-outline-success"
            onclick="guardarOpcionMenu()">Guardar</button>
            <button type="button" class="btn btn-outline-danger"
            onclick="document.getElementById('capaEditarCrear').innerHTML = '';">Cancelar</button>
            <span id="msjError" name="msjError" style="color:blue;"></span>
        </div>
    </div>