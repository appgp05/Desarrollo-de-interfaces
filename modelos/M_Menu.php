<?php
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
class M_Menu extends Modelo{
    public $DAO;

    public function __construct(){
        parent::__construct(); //ejecutar constructor padre
        $this->DAO = new DAO();
    }

    public function getMenu($datos = array()){
        $SQL="SELECT * FROM menu ORDER BY nivel, orden";
        $menu=$this->DAO->consultar($SQL);

        // echo $SQL;
        // $id_Usuario='';
        return $menu;
    }

    public function buscarOpcionesMenu($filtros=array()){
        $ftexto="";
        // $factivo="";
        $id="";
        extract($filtros);
        
        
        $SQL="SELECT * FROM menu WHERE 1=1";
        

        if($ftexto!=""){
            $aPalabras=explode(' ',$ftexto);

            $SQL.=" AND 1 = 2";

            foreach($aPalabras as $word){
                    $SQL.=" OR (titulo LIKE '%$word%')";
            }
        }

        // if($factivo!=''){
        //     $SQL.=" AND activo='$factivo' ";
        // }
        if($id!=''){
            $SQL.=" AND id='$id' ";
        }

        $SQL.=' ORDER BY nivel, orden';

        $opcionesMenu = $this->DAO->consultar($SQL);
        

        return $opcionesMenu;
    }

    public function insertarOpcionMenu($datos=Array()){
        $id='';
        $titulo='';
        $url='';
        $nivel='';
        $padre_id='';
        $orden='';
        $es_dropdown='';
        $controladorMenu='';
        $metodoMenu='';
        $destinoMenu='';
        $hijo='';
        extract($datos);
        
        $SQL="INSERT INTO menu SET
                titulo='$titulo',
                url='$url',";
        // if(isset($hijo)){
        //     if($hijo === true){
        //         $SQL.="nivel='3',";
        //     } else {
        //         $SQL.="nivel='2',";
        //     }
        // } else {
            $SQL.="nivel='$nivel',";
        // }

        $SQL.="padre_id='$padre_id',
                orden='$orden',
                es_dropdown='$es_dropdown',
                controladorMenu='$controladorMenu',
                metodoMenu='$metodoMenu',
                destinoMenu='$destinoMenu'";

        // $SQL.="SELECT LAST_INSERT_ID() AS id;";
        return $this->DAO->insertar($SQL);
    }

    public function actualizarOpcionesPorDebajoMenu($datos=Array()){
        $nivel='';
        $orden='';
        $padre_id='';
        extract($datos);

        $SQL="UPDATE menu SET orden = orden + 1 WHERE nivel = $nivel AND orden >= $orden";
        if(isset($padre_id) && $padre_id != ''){
           $SQL.=" AND padre_id = $padre_id"; 
        }
        return $this->DAO->actualizar($SQL);
    }

    public function editarOpcionMenu($datos=Array()){
        $id='';
        $titulo='';
        $url='';
        $nivel='';
        $padre_id='';
        $orden='';
        $es_dropdown='';
        $controladorMenu='';
        $metodoMenu='';
        $destinoMenu='';
        extract($datos);
        
        $SQL="UPDATE menu SET
                id='$id',
                titulo='$titulo',
                url='$url',
                nivel='$nivel',
                padre_id='$padre_id',
                orden='$orden',
                es_dropdown='$es_dropdown',
                controladorMenu='$controladorMenu',
                metodoMenu='$metodoMenu',
                destinoMenu='$destinoMenu'
                WHERE id = '$id'";
        return $this->DAO->actualizar($SQL);
    }
}
?>