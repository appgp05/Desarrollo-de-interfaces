<?php
    $getPost = array_merge($_GET, $_POST, $_FILES);

    if(isset($getPost['controlador']) && $getPost['controlador'] !=''){
        //Recibido controlador
        $controlador='C_'.$getPost['controlador'];
        if(file_exists('./controladores/'.$controlador.'.php')){
            //Existe el controlador
            $metodo=$getPost['metodo'];
            require_once './controladores/'.$controlador.'.php';
            $objControlador= new $controlador();
            if(method_exists($objControlador, $metodo)){
                $objControlador->$metodo($getPost);
            } else {
                echo 'Error CF_03'; //No exixte el metodo
            }
        } else {
            echo 'Error CF-02'; //No exixte el fichero de controlador;
        }
    } else {
        //No recibido controlador
        echo 'Error CF-01';
    }
?>