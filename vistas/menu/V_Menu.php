<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdownDynamic" aria-controls="navbarNavDropdownDynamic" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdownDynamic">
            <ul class="navbar-nav">
                <?php 
                $menuArray = Array();
                extract($datos);
                echo menuOptions($menuArray); 
                ?>
            </ul>
        </div>
    </div>
</nav>

<?php
// function menuOptions($items) {
//     $html = '';
//     // $orderedItems = Array();
//     // for($i = 0; $i < sizeof($items); $i++){
//     //     // array_push($orderedItems, $items[$i]);
//     //     if($items[$i]['nivel'] == 1){
//     //         if($items[$i]['es_dropdown']){
//     //             $items[$i]['hijos'] = array();
//     //         }
//     //         $orderedItems[$items[$i]['id']] = $items[$i];
//     //     } else {
//     //         $orderedItems[$items[$i]['padre_id']]['hijos'] = $items[$i];
//     //     }
//     // }

//     // echo json_encode($orderedItems);

//     // foreach ($orderedItems as $item) {
//     //     if ($item['padre_id'] == null) {
//     //         if ($item['es_dropdown']) {
//     //             $html .= '<li class="nav-item dropdown">';
//     //             $html .= '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . htmlspecialchars($item['titulo']) . '</a>';
//     //             $html .= '<ul class="dropdown-menu">';
//     //             $arrayTemp = Array();
//     //             $arrayTemp = $item['hijos'];
//     //             foreach ($arrayTemp as $itemChild){
//     //                 echo "aaaaaaaaaaaaaaa".json_encode($itemChild);
//     //                 $html .= '<li class="nav-item">';
//     //                 $onclick = '';
//     //                 if ($itemChild['controlador'] && $itemChild['metodo']) {
//     //                     $onclick = ' onclick="obtenerVista(\'' . $itemChild['controlador'] . '\',\'' . $itemChild['metodo'] . '\',\'capaContenido\');"';
//     //                 }
//     //                 $html .= '<a class="nav-link"' . $onclick . ' href="' . htmlspecialchars($itemChild['url']) . '">' . htmlspecialchars($itemChild['titulo']) . '</a>';
//     //             }

//     //             // $html .= menuOptions($items, $item['id']);
//     //             $html .= '</ul>';
//     //         } else {
//     //             $html .= '<li class="nav-item">';
//     //             $onclick = '';
//     //             if ($item['controlador'] && $item['metodo']) {
//     //                 $onclick = ' onclick="obtenerVista(\'' . $item['controlador'] . '\',\'' . $item['metodo'] . '\',\'capaContenido\');"';
//     //             }
//     //             $html .= '<a class="nav-link"' . $onclick . ' href="' . htmlspecialchars($item['url']) . '">' . htmlspecialchars($item['titulo']) . '</a>';
//     //         }
//     //         $html .= '</li>';
//     //     }
//     // }

//     // $html = json_encode($orderedItems);


//     // foreach ($items as $item) {
//     //     if ($item['padre_id'] == null) {
//     //         if ($item['es_dropdown']) {
//     //             $html .= '<li class="nav-item dropdown">';
//     //             $html .= '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . htmlspecialchars($item['titulo']) . '</a>';
//     //             $html .= '<ul class="dropdown-menu">';
//     //             $html .= menuOptions($items, $item['id']);
//     //             $html .= '</ul>';
//     //         } else {
//     //             $html .= '<li class="nav-item">';
//     //             $onclick = '';
//     //             if ($item['controlador'] && $item['metodo']) {
//     //                 $onclick = ' onclick="obtenerVista(\'' . $item['controlador'] . '\',\'' . $item['metodo'] . '\',\'capaContenido\');"';
//     //             }
//     //             $html .= '<a class="nav-link"' . $onclick . ' href="' . htmlspecialchars($item['url']) . '">' . htmlspecialchars($item['titulo']) . '</a>';
//     //         }
//     //         $html .= '</li>';
//     //     }
//     // }
//     return $html;
// }

function menuOptions($items, $parent = 0) {
    $html = '';
    foreach ($items as $item) {
        if ($item['padre_id'] == $parent) {
            // echo str_replace(' ', '', strtolower('acceso'.$item['titulo']));
            // echo $_SESSION['permisosSesion'];
            
            $permisoBuscado = strtolower(str_replace(' ', '', 'acceso' . $item['titulo']));  // Formato del permiso a buscar
                        
            $permisosSesion = array_map('strtolower', array_column($_SESSION['permisosSesion'], 'permiso'));

            if (in_array($permisoBuscado, $permisosSesion)) {
            
            
            // if(strtolower(array_column($_SESSION['permisosSesion'], 'permiso')).include(str_replace(' ', '', strtolower('acceso'.$item['titulo'])))){
                if ($item['es_dropdown']) {
                    $html .= '<li class="nav-item dropdown">';
                    $html .= '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . htmlspecialchars($item['titulo']) . '</a>';
                    $html .= '<ul class="dropdown-menu">';
                    $html .= menuOptions($items, $item['id']);
                    $html .= '</ul>';
                } else {
                    $html .= '<li class="nav-item">';
                    $controladorMenu = '';
                    $metodoMenu = '';
                    $destinoMenu = '';
                    $onclick = '';
                    if ($item['controladorMenu']!='' && $item['metodoMenu'] && $item['destinoMenu']) {
                        $controladorMenu = $item['controladorMenu'];
                        $metodoMenu = $item['metodoMenu'];
                        $destinoMenu = $item['destinoMenu'];
                        $onclick = '\''.$controladorMenu.'\', \''.$metodoMenu.'\', \''.$destinoMenu.'\'';
                        $onclick = ' onclick="obtenerVista('.$onclick.');"';
                    }
                    $html .= '<a class="nav-link"' . $onclick . ' href="' . htmlspecialchars($item['url']) . '">' . htmlspecialchars($item['titulo']) . '</a>';
                }
                $html .= '</li>';
            }
        }
    }
    return $html;
}
?>