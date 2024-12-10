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
    $mostrarEchos = true;

    $id='';
    $titulo='';
    $url='';
    $nivel='0';
    $padre_id='0';
    $orden='0';
    $es_dropdown='';
    $controladorMenu='';
    $metodoMenu='';
    $destinoMenu='';
    if(isset($datos['opcionMenu'])){
        extract($datos['opcionMenu']);
        $editar= 'Editar';
    } else {
        $editar= 'Nuevo';
    }

    if(isset($datos['nivel'])){
        $nivel=$datos['nivel'];
        if($mostrarEchos){
            echo "hijo: ".$nivel;
        }
    }
    if(isset($datos['padre_id'])){
        $padre_id=$datos['padre_id'];
        if($mostrarEchos){
            echo "padre_id: ".$padre_id;
        }
    }
    if(isset($datos['orden'])){
        $orden=$datos['orden'];
        if($mostrarEchos){
            echo "orden: ".$orden;
        }
    }
    // if(isset($datos['tr'])){
    //     $tr = $datos['tr'];
    //     if($mostrarEchos){
    //         echo "tr: ".$tr;
    //     }
    // }
    if(isset($datos['newTr'])){
        $newTr = $datos['newTr'];
        if($mostrarEchos){
            echo "newTr: ".$newTr;
        }
    }

    // echo "aaaa ".$hijo;

    // $cHombre = $sexo=='H' ? ' selected ': '';
    // $cMujer = $sexo=='M' ? ' selected ': '';
    // $cOtro = $sexo=='O' ? ' selected ': '';
    // $cNoLoDigo = $sexo=='P' ? ' checked ': '';
?>
        <?php if($editar=='Editar'):?>
        <td style="display: none;">
            <form class="formularioEdicion" name="formularioEdicion">
                <input type="text" id="id" name="id"
                    class="form-control formId" placeholder="Id" value="<?php echo $id; ?>">
            </form>
        </td>
        <?php endif; ?>    
        <td>
            <form class="formularioEdicion" name="formularioEdicion">
                <input type="text" id="titulo" name="titulo"
                    class="form-control formTitulo" placeholder="Titulo" value="<?php echo $titulo; ?>">
            </form>
        </td>
        <td>
            <form class="formularioEdicion" name="formularioEdicion">
                <input type="text" id="url" name="url"
                    class="form-control formUrl" placeholder="Url" value="<?php echo $url ?>">
            </form>
        </td>
        <td>
            <form class="formularioEdicion" name="formularioEdicion">
                <input type="text" id="nivel" name="nivel"
                    class="form-control formNivel" placeholder="Nivel" value="<?php echo $nivel ?>">
            </form>
        <td>
        <td>
            <form class="formularioEdicion" name="formularioEdicion">
                <input type="text" id="padre_id" name="padre_id"
                    class="form-control formPadre_id" placeholder="Padre Id" value="<?php echo $padre_id ?>">
            </form>
        </td>
        <td>
            <form class="formularioEdicion" name="formularioEdicion">
                <input type="text" id="orden" name="orden"
                    class="form-control formOrden" placeholder="Orden" value="<?php echo $orden ?>">
            </form>
        </td>
        <td>
            <form class="formularioEdicion" name="formularioEdicion">
                <input type="text" id="es_dropdown" name="es_dropdown"
                    class="form-control formEs_dropdown" placeholder="Es dropdown" value="<?php echo $es_dropdown ?>">
            </form>
        </td>
        <td>
            <form class="formularioEdicion" name="formularioEdicion">
                <input type="text" id="controladorMenu" name="controladorMenu"
                    class="form-control formControladorMenu" placeholder="Controlador" value="<?php echo $controladorMenu ?>">
            </form>
        </td>
        <td>
            <form class="formularioEdicion" name="formularioEdicion">
                <input type="text" id="metodoMenu" name="metodoMenu"
                    class="form-control formMetodoMenu" placeholder="Metodo" value="<?php echo $metodoMenu ?>">
            </form>
        </td>
        <td>
            <form class="formularioEdicion" name="formularioEdicion">
                <input type="text" id="destinoMenu" name="destinoMenu"
                    class="form-control formDestinoMenu" placeholder="Destino" value="<?php echo $destinoMenu ?>">
            </form>
        </td>
    <!-- <form id="formularioEdicion" name="formularioEdicion">
            <?php if($editar=='Editar'):?>
            <div class="form-group col-md-1 col-sm-2 col-xs-3" style="display: none;">
                <label for="">Id</label>
                <input type="text" id="id" name="id"
                    class="form-control" placeholder="Id" value="<?php echo $id; ?>">
            </div>
            <?php endif; ?>    
            <td>
                    <label for="">Titulo</label>
                    <input type="text" id="titulo" name="titulo"
                        class="form-control" placeholder="Titulo" value="<?php echo $titulo; ?>">
            </td>
            <td>
                    <input type="text" id="url" name="url"
                        class="form-control" placeholder="Url" value="<?php echo $url ?>">
            </td>
            <td>
                    <input type="text" id="nivel" name="nivel"
                        class="form-control" placeholder="Nivel" value="<?php echo $nivel;  ?>">
            <td>
            <td>
                    <input type="text" id="padre_id" name="padre_id"
                        class="form-control" placeholder="Padre Id" value="<?php echo $padre_id ?>">
            </td>
            <td>
                    <input type="text" id="orden" name="orden"
                        class="form-control" placeholder="Orden" value="<?php echo $orden ?>">
            </td>
            <td>
                    <input type="text" id="es_dropdown" name="es_dropdown"
                        class="form-control" placeholder="Es dropdown" value="<?php echo $es_dropdown ?>">
            </td>
            <td>
                <input type="text" id="onclick" name="onclick"
                    class="form-control" placeholder="Onclick" value="<?php echo $onclick ?>">
            </td>
    </form> -->
    <div class="row">
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
            onclick="guardarOpcionMenuFila(<?php echo $newTr ?>);">Guardar</button>
            <button type="button" class="btn btn-outline-danger"
            onclick="document.getElementById('newTr<?php echo $newTr?>').outerHTML = '';">Cancelar</button>
            <span id="msjError" name="msjError" style="color:blue;"></span>
        </div>
    </div>