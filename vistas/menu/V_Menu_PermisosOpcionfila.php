<?php
class V_Menu_PermisosOpcionfila{
    static public function getPermisosOpcionMenuFila($id, $permisos){
        // console.log("llego " + id + " " + originalTrId);
        // $newTr.innerHTML = ``;

        $html = "";
        $html .= '<tr id="permissionTr'.$id.'">';
        $html .= '  <td>
                        <form class="formularioEdicion" name="formularioEdicion">
                            <input type="text" id="permiso" name="permiso" placeholder="Permiso">
                            <input type="text" id="codigo_Permiso" name="codigo_Permiso" placeholder="Código permiso">
                            <button type="button" onclick="guardarPermisoOpcionMenuFila('.$id.', '."'insertar'".')">Añadir permiso</button>
                        </form>
                    </td>';

        $html .= '<td colspan="4">';

        if(empty($permisos)){
            $html.='No existen permisos';
        } else {
            foreach ($permisos as $permiso) {
                $html.="
                    <p>Id: ".$permiso['id'].", Permiso: ".$permiso['permiso'].", Menu: ".$permiso['id_Menu'].", Código: ".$permiso['codigo_Permiso']."</p><button onclick=".'"abrirEdicionPermisoOpcionMenuFila('.$id.' , '."'".$permiso['permiso']."'".' , '."'".$permiso['codigo_Permiso']."'".' , '.$permiso['id'].')"'.">Editar</button><button type=".'"button"'." onclick=".'"guardarPermisoOpcionMenuFila('.$id.', '."'eliminar'".', '.$permiso['id'].')"'.">Eliminar</button><br>
                ";
            }
        }
        $html .= '</td>';
        $html .= '</tr>';

        return $html;
    }
}
?>