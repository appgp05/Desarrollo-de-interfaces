<?php
class V_Menu_PermisosOpcionfila{
    static public function getPermisosOpcionMenuFila($id, $permisosGenerales, $permisosOpcionMenu, $listaPermisosUsuarioORol, $listaPermisosUsuarioPorRol, $usuario, $rol){
        // console.log("llego " + id + " " + originalTrId);
        // $newTr.innerHTML = ``;

        if($usuario == 0 && $rol == 0){
            $usuarioORol = '';
            $usuarioORolId = 0;
        } else {
            if($usuario != 0){
                $usuarioORol = 'usuario';
                $usuarioORolId = $usuario;
            }
            if($rol != 0){
                $usuarioORol = 'rol';
                $usuarioORolId = $rol;
            }
        }

        $html = "";
        $html .= '<tr id="permissionTr'.$id.'">';
        if($usuario == 0 && $rol == 0){
            $html .= '  <td>
                            <form class="formularioEdicion" name="formularioEdicion">
                                <input type="text" id="permiso" name="permiso" placeholder="Permiso">
                                <input type="text" id="codigo_Permiso" name="codigo_Permiso" placeholder="Código permiso">
                                <button type="button" onclick="guardarPermisoOpcionMenuFila('.$id.', '."'insertar'".')">Añadir permiso</button>
                            </form>
                        </td>';

        }

        $html .= '<td colspan="4">';
        // if($usuario == 0 && $rol == 0){
            if(empty($permisosOpcionMenu)){
                $html.='No existen permisos';
            } else {
                foreach ($permisosOpcionMenu as $permiso) {
                    // echo '<pre>';
                    // print_r($permiso);
                    // echo '</pre>';
                    // echo '<pre>';
                    // print_r($listaPermisosUsuarioORol);
                    // echo '</pre>';
                    if($usuario != 0 || $rol != 0){
                        if(in_array($permiso['id'], array_column($listaPermisosUsuarioORol, 'id_Permiso'))){
                            $html.="<input type=".'"'."checkbox".'"'." checked onchange=".'"'."actualizarUsuarioORolPorPermiso("."'".$usuarioORol."'".", ".$usuarioORolId.", ".$permiso['id'].")".'"'.">";
                        } else {
                            $html.="<input type=".'"'."checkbox".'"'." onchange=".'"'."actualizarUsuarioORolPorPermiso("."'".$usuarioORol."'".", ".$usuarioORolId.", ".$permiso['id'].")".'"'.">";
                        }
                    }
                    
                    $html.="
                        <p>Id: ".$permiso['id'].", Permiso: ".$permiso['permiso'].", Menu: ".$permiso['id_Menu'].", Código: ".$permiso['codigo_Permiso']."</p>
                    ";

                    if($usuario == 0 && $rol == 0){
                        $html.="<button onclick=".'"abrirEdicionPermisoOpcionMenuFila('.$id.' , '."'".$permiso['permiso']."'".' , '."'".$permiso['codigo_Permiso']."'".' , '.$permiso['id'].')"'.">Editar</button>
                        <button type=".'"button"'." onclick=".'"guardarPermisoOpcionMenuFila('.$id.', '."'eliminar'".', '.$permiso['id'].')"'.">Eliminar</button>";
                    }
                    
                    // foreach ($listaPermisosUsuarioORol as $permisoUsuarioPorRol){
                    //     if(in_array($permiso['id'], array_column($permisoUsuarioPorRol, 'id_Permiso'))){
                    //         $html.="<p>$permisoUsuarioPorRol['rol']</p>";
                    //         echo 'asdasd';
                    //     }
                    // }

                    // foreach ($listaPermisosUsuarioPorRol as $permisoUsuarioPorRol) {
                    //     if (in_array($permiso['id'], array_column($permisoUsuarioPorRol, 0, 'id_Permiso'))) {
                    //         echo 'asdasd';
                    //         $html .= "<p>".$permisoUsuarioPorRol[1]['rol']."</p>";
                    //     }
                    // }
                    
                    foreach ($listaPermisosUsuarioPorRol as $permisoUsuarioPorRol) {
                        // Extraemos el array que contiene los permisos
                        $permisos = array_column([$permisoUsuarioPorRol[0]], 'id_Permiso');
                    
                        // Verificamos si el permiso está en la lista de permisos
                        if (in_array($permiso['id'], $permisos)) {
                            $html .= '<p class="backgroundRoles">'.$permisoUsuarioPorRol[1]['rol'].'</p>';
                            // echo 'asdasd';
                        }
                    }
                    
                    

                    $html.="<br>";
                }
            }
        // } else {
        //     foreach ($permisosGenerales as $permiso){
        //         if(in_array($permiso, $permisosOpcionMenu)){
        //             $html.="<input type=".'"'."checkbox".'"'." checked onchange=".'"'."actualizarUsuarioORolPorPermiso("."'".$usuarioORol."'".", ".$usuarioORolId.", ".$permiso['id'].")".'"'.">";
        //         } else {
        //             $html.="<input type=".'"'."checkbox".'"'." onchange=".'"'."actualizarUsuarioORolPorPermiso("."'".$usuarioORol."'".", ".$usuarioORolId.", ".$permiso['id'].")".'"'.">";
        //         }
        //         $html.="
        //             <p>Id: ".$permiso['id'].", Permiso: ".$permiso['permiso'].", Menu: ".$permiso['id_Menu'].", Código: ".$permiso['codigo_Permiso']."</p>
        //         ";
        //     }
        // }
        $html .= '</td>';
        $html .= '</tr>';

        return $html;
    }
}
?>