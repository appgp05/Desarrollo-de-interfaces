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
                id='$id',
                permiso='$permiso',
                id_Menu='$id_Menu',
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
<<<<<<< Updated upstream
=======

    public function buscarRoles(){
        $SQL="SELECT * FROM roles";
        return $this->DAO->consultar($SQL);
    }

    public function buscarUsuarios(){
        $SQL="SELECT * FROM usuarios";
        return $this->DAO->consultar($SQL);
    }

    public function buscarPermisosUsuario($id){
        $SQL="SELECT * FROM permisosusuarios WHERE id_Usuario = ".$id;
        // echo $SQL;
        return $this->DAO->consultar($SQL);
    }

    public function buscarRolesUsuario($id){
        $SQL="SELECT * FROM rolesusuarios WHERE id_Usuario = ".$id;
        // echo $SQL;
        return $this->DAO->consultar($SQL);
    }

    public function buscarPermisosRol($id){
        $SQL="SELECT * FROM permisosroles WHERE id_Rol = ".$id;
        return $this->DAO->consultar($SQL);
    }

    public function actualizarUsuarioConPermiso($datos=Array()){
        // $SQL="UPDATE `usuarios` SET `activo` = CASE WHEN `activo` = 'N' THEN 'S' ELSE 'N' END WHERE `id_Usuario` = '$id_Usuario';";
        // $SQL="CASE NOT EXISTS INSERT INTO permisosusuarios VALUES ( 1, 3); ELSE DELETE FROM permisosusuarios WHERE id_Usuario = 1 AND id_Permiso = 3";
        // $SQL="INSERT INTO permisosusuarios VALUES ( ".$usuario.", ".$permiso.")";

        // $SQL="IF NOT EXISTS (SELECT 1 FROM permisosusuarios WHERE id_Usuario = ".$usuario." AND id_Permiso = ".$permiso.") THEN
        //         INSERT INTO permisosusuarios (id_Usuario, id_Permiso) VALUES (".$usuario.", ".$permiso.");
        //     ELSE
        //         DELETE FROM permisosusuarios WHERE id_Usuario = ".$usuario." AND id_Permiso = ".$permiso.";
        //     END IF;";

        if($datos['usuarioORol'] === 'usuario'){
            $SQL="SELECT * FROM permisosusuarios WHERE id_Usuario = ".$datos['usuarioORolId']." AND id_Permiso = ".$datos['permiso'];
            $id=$this->DAO->consultar($SQL);
            // print_r($id);
            if(isset($id) && $id != []){
                $SQL="DELETE FROM permisosusuarios WHERE id_Usuario = ".$datos['usuarioORolId']." AND id_Permiso = ".$datos['permiso'];
                $this->DAO->borrar($SQL);
            } else {
                $SQL="INSERT INTO permisosusuarios (id_Usuario, id_Permiso) VALUES (".$datos['usuarioORolId'].", ".$datos['permiso'].")";
                $this->DAO->insertar($SQL);
            }
        } else if($datos['usuarioORol'] === 'rol'){
            $SQL="SELECT * FROM permisosroles WHERE id_Rol = ".$datos['usuarioORolId']." AND id_Permiso = ".$datos['permiso'];
            $id=$this->DAO->consultar($SQL);
            // print_r($id);
            if(isset($id) && $id != []){
                $SQL="DELETE FROM permisosroles WHERE id_Rol = ".$datos['usuarioORolId']." AND id_Permiso = ".$datos['permiso'];
                $this->DAO->borrar($SQL);
            } else {
                $SQL="INSERT INTO permisosroles (id_Rol, id_Permiso) VALUES (".$datos['usuarioORolId'].", ".$datos['permiso'].")";
                $this->DAO->insertar($SQL);
            }
        }

        // $SQL="INSERT INTO permisosusuarios (id_Usuario, id_Permiso) VALUES ($usuario, $permiso) ON DUPLICATE KEY UPDATE id_Usuario = 0, id_Permiso = 0;
        // DELETE FROM permisosusuarios WHERE id_Usuario = 0 AND id_Permiso = 0;";
        
        // $this->DAO->insertar($SQL);
    }

    public function obtenerRoles(){
        $SQL="SELECT * FROM roles;";
        return $this->DAO->consultar($SQL);
    }

    public function crearRol($datos){
        $rol='';
        extract($datos);

        $SQL="INSERT INTO `roles` (`rol`) VALUES ('$rol');";
        $this->DAO->insertar($SQL);
    }

    public function editarRol($datos){
        $id='';
        $rol='';
        extract($datos);
        // echo $SQL;
        $SQL="UPDATE roles SET rol = '$rol' WHERE id = $id";
        $this->DAO->actualizar($SQL);
    }

    public function eliminarRol($datos){
        $id='';
        extract($datos);

        $SQL="DELETE FROM roles WHERE id = $id";
        $this->DAO->borrar($SQL);
    }
>>>>>>> Stashed changes
}
?>