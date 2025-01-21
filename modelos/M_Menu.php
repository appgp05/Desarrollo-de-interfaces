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
        // print_r($menu);
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

        foreach($opcionesMenu as $key => $opcionMenu){
            $SQL = "SELECT * FROM `permisos` WHERE id_Menu = ".$opcionMenu['id']." ORDER BY id ASC";
            // echo $SQL;
            $permisosOpcionMenu = $this->DAO->consultar($SQL);
            // echo sizeof($permisosOpcionesMenu);
            if(!empty($permisosOpcionMenu)){
                $opcionesMenu[$key]['permisosOpcionMenu'] = $permisosOpcionMenu;
            }
        }
        
        // echo('<pre>');
        // print_r($opcionesMenu);
        // echo('</pre>');

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

    public function getPermisos(){
        $SQL="SELECT * FROM permisos";
        return $this->DAO->consultar($SQL);
    }

    public function getPermisosOpcionMenu($id_Menu){
        $SQL="SELECT * FROM permisos WHERE id_Menu = ".$id_Menu;
        return $this->DAO->consultar($SQL);
    }

    public function insertarPermisoOpcionMenu($datos=Array()){
        $id='';
        $permiso='';
        $id_Menu='';
        $codigo_Permiso='';
        extract($datos);
        
        $SQL="INSERT INTO permisos SET
                id='$id',
                permiso='$permiso',
                id_Menu='$id_Menu',
                codigo_Permiso='$codigo_Permiso'";

        return $this->DAO->insertar($SQL);
    }

    public function editarPermisoOpcionMenu($datos=Array()){
        $id='';
        $permiso='';
        $id_Menu='';
        $codigo_Permiso='';
        extract($datos);
        
        $SQL="UPDATE permisos SET
                permiso='$permiso',
                codigo_Permiso='$codigo_Permiso'
                WHERE id = '$id'";
        return $this->DAO->actualizar($SQL);
    }

    public function eliminarPermisoOpcionMenu($datos=Array()){
        $id='';
        extract($datos);
        
        $SQL="DELETE FROM `permisos` WHERE id = ".$id;
        return $this->DAO->borrar($SQL);
    }

    public function buscarRoles(){
        $SQL="SELECT * FROM roles";
        return $this->DAO->consultar($SQL);
    }

    public function buscarUsuarios(){
        $SQL="SELECT * FROM usuarios";
        return $this->DAO->consultar($SQL);
    }
}
?>