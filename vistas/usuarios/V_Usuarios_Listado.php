<?php session_start();
//$usuarios=$datos['usuarios'];
$usuarios=array();
extract($datos);

$html='';
$html.='<div class="table-responsive">
        <table class="table table-sm table-striped">';
$html.='<thead>
            <tr>
                <th>Apellidos, nombre</th>
                <th>Mail</th>
                <th>login</th>
                <th>¿Activo?</th>
                <th>Editar</th>
                <th>Cambiar estado</th>
            </tr>
        </thead>
        <tbody>';
    $activo='';
    foreach($usuarios as $posicion=>$fila){
    // echo $fila['nombre'];
    // echo '<br>';
    $estilo='';
    if($fila['activo']=='N'){
        $activo='Inactivo';
        $estilo='color:red;';
    } else {
        $activo='';
    }

    $html.='<tr>
                <td nowrap id="nombreApellidoFila'.$fila['id_Usuario'].'" style="'.$estilo.'">'.$fila['apellido_1'].', '.$fila['apellido_2'].', '.$fila['nombre'].'</td>
                <td>'.$fila['mail'].'</td>
                <td>'.$fila['login'].'</td>
                <td id="activoFila'.$fila['id_Usuario'].'">'.$activo.'</td>';
                
                $permisosSesion = array_map('strtolower', array_column($_SESSION['permisosSesion'], 'permiso'));
            
                $permisoBuscado = 'editarusuario';

                if (in_array($permisoBuscado, $permisosSesion)) {
                    $html.='<td><button class="btn btn-outline-primary" onclick="obtenerVista_EditarCrear(\'Usuarios\', \'getVistaNuevoEditar\', \'capaEditarCrear\', \''.$fila['id_Usuario'].'\')">Editar</button></td>';
                } else {
                    $html.='<td></td>';
                }
                $html.='<td><button class="btn btn-outline-primary" onclick="cambiarEstadoUsuario('.$fila['id_Usuario'].')">Cambiar estado</button></td>
            </tr>';
}

$html.='</tbody>
</table></div>';

echo $html;
?>