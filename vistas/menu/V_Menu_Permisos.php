<?php
    $mostrarEchos = true;

    $permisos=Array();
    
    if(isset($datos['permisosOpcionMenu'])){
        extract($datos['permisosOpcionMenu']);
    }

    if(!empty($permisos)){
        foreach($permisos as $permiso){
            $html = `
            <td>
                $permiso
                <button>Editar</button>
                <button>Eliminar</button>
            </td>
            `;
        }
        $html.=`<button>Añadir</button>`;
        echo $html;
    }
?>