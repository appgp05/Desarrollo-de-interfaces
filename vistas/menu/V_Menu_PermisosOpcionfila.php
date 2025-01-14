<?php
class V_Menu_PermisosOpcionfila{
    static public function getPermisosOpcionMenuFila($id, $permisos){
        // console.log("llego " + id + " " + originalTrId);
        // $newTr.innerHTML = ``;

        $html = "";
        $html .= `<tr id="permissionTr$id">`;
        $html .= `  <td>
                        <input type="text" placeholder="Permiso">
                        <input type="text" placeholder="Código permiso">
                        <button>Añadir permiso</button>
                    </td>`;

        $html .= `<td colspan="4">`;

        foreach ($permisos as $key => $permiso) {
            $html.=`
                Id: `.$permiso['id'].`, Permiso: `.$permiso['permiso'].`, Menu: `.$permiso['id_Menu'].`, Código: `.$permiso['codigo_Permiso'].` <button>Editar</button><button>Eliminar</button><br>
            `;
        }
        $html .= '</td>';
        $html .= '</tr>';

        return $html;
    }
}
?>