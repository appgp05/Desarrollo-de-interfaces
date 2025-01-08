<?php
include 'permisos.php';
//$usuarios=$datos['usuarios'];
$opcionesMenu=array();
extract($datos);

$html='';
$html.='<div class="table-responsive">
        <table class="table table-sm table-striped" >';
$html.='<thead>
            <tr>
                <th>ID</th>
                <th>Titutlo</th>
                <th>Url</th>
                <th>Nivel</th>
                <th>Id padre</th>
                <th>Orden</th>
                <th>Dropdown</th>
                <th>Controlador</th>
                <th>Metodo</th>
                <th>Destino</th>
                <th>Añadir por debajo</th>
                <th>Añadir hijo</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody id="tablaMenu">';
    // $activo='';
    foreach($opcionesMenu as $posicion=>$fila){
    // echo $fila['nombre'];
    // echo '<br>';
    // $estilo='';
    // if($fila['activo']=='N'){
    //     $activo='Inactivo';
    //     $estilo='color:red;';
    // } else {
    //     $activo='';
    // }

    // $html.='<tr>
    //             <td nowrap id="nombreApellidoFila'.$fila['id_Usuario'].'" style="'.$estilo.'">'.$fila['apellido_1'].', '.$fila['apellido_2'].', '.$fila['nombre'].'</td>
    //             <td>'.$fila['mail'].'</td>
    //             <td>'.$fila['login'].'</td>
    //             <td id="activoFila'.$fila['id_Usuario'].'">'.$activo.'</td>
    //             <td><button class="btn btn-outline-primary" onclick="obtenerVista_EditarCrear(\'Usuarios\', \'getVistaNuevoEditar\', \'capaEditarCrear\', \''.$fila['id_Usuario'].'\')">Editar</button></td>
    //             <td><button class="btn btn-outline-primary" onclick="cambiarEstadoUsuario('.$fila['id_Usuario'].')">Cambiar estado</button></td>
    //         </tr>';
    $html.='<tr id="tr'.$fila['id'].'">
                <td class="id">'.$fila['id'].'</td>
                <td class="titulo">'.$fila['titulo'].'</td>
                <td class="url">'.$fila['url'].'</td>
                <td class="nivel">'.$fila['nivel'].'</td>
                <td class="padre_id">'.$fila['padre_id'].'</td>
                <td class="orden">'.$fila['orden'].'</td>
                <td class="es_dropdown">'.$fila['es_dropdown'].'</td>
                <td class="controladorMenu">'.$fila['controladorMenu'].'</td>
                <td class="metodoMenu">'.$fila['metodoMenu'].'</td>
                <td class="destinoMenu">'.$fila['destinoMenu'].'</td>
                <td><button class="btn btn-outline-primary" onclick="añadirFila('.$fila['id'].', '.$fila['id'].'); obtenerVista_EditarCrearMenuFila(\'Menu\', \'getVistaNuevoEditarFila\', \'newTr'.$fila['id'].'\', \'\', \''.$fila['nivel'].'\', \''.$fila['padre_id'].'\', \''.($fila['orden'] + 1).'\', \''.$fila['id'].'\'); obtenerVista_EditarCrearMenu(\'Menu\', \'getVistaNuevoEditar\', \'capaEditarCrear\', \'\', \''.$fila['nivel'].'\', \''.$fila['padre_id'].'\', \''.($fila['orden'] + 1).'\')">Añadir por debajo</button></td>
                ';
                if($fila['es_dropdown'] == 1){
                    $html.='<td><button class="btn btn-outline-primary" onclick="añadirFila('.$fila['id'].', '.$fila['id'].'); obtenerVista_EditarCrearMenuFila(\'Menu\', \'getVistaNuevoEditarFila\', \'newTr'.$fila['id'].'\', \'\', \''.($fila['nivel'] + 1).'\', \''.$fila['id'].'\', \'1\', \''.$fila['id'].'\'); obtenerVista_EditarCrearMenu(\'Menu\', \'getVistaNuevoEditar\', \'capaEditarCrear\', \'\', \''.($fila['nivel'] + 1).'\', \''.$fila['id'].'\', \'1\')">Añadir hijo</button></td>';
                } else {
                    $html.='<td></td>';
                }
    $html.='<td><button class="btn btn-outline-primary" onclick="añadirFila('.$fila['id'].', '.$fila['id'].'); obtenerVista_EditarCrearMenuFila(\'Menu\', \'getVistaNuevoEditarFila\', \'newTr'.$fila['id'].'\', \''.$fila['id'].'\', \'\', \'\', \'\', \''.$fila['id'].'\'); obtenerVista_EditarCrearMenu(\'Menu\', \'getVistaNuevoEditar\', \'capaEditarCrear\', \''.$fila['id'].'\', \'\', \'\', \'\')">Editar</button></td>
            </tr>';
    $html.='<tr></tr>';
}

$html.='</tbody>
</table></div>';

echo $html;
?>