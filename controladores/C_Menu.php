<?php
    require_once './controladores/Controlador.php';
    require_once './modelos/M_Menu.php';
    require_once './vistas/Vista.php';
    class C_Menu extends Controlador{
        private $modelo;

        public function __construct(){
            parent::__construct();
            $this->modelo = new M_Menu();
        }

        public function renderMenu() {
            $menuArray=$this->modelo->getMenu();
            vista::render('./vistas/menu/V_Menu.php', array('menuArray'=>$menuArray));
        }

        public function getVistaFiltros($datos=array()){
            $usuarios=$this->modelo->buscarUsuarios();
            $roles=$this->modelo->buscarRoles();
            Vista::render('./vistas/menu/V_Menu_Filtros.php', array('usuarios'=>$usuarios, 'roles'=>$roles));
        }

        public function getVistaListadoOpcionesMenu($filtros=array()){
            if(isset($filtros['ftextoUsuario']) && isset($filtros['ftextoRol']) && $filtros['ftextoUsuario'] == 0 || $filtros['ftextoRol'] == 0){
                // var_dump($filtros);
                $opcionesMenu=$this->modelo->buscarOpcionesMenu($filtros);
                $permisos=$this->modelo->getPermisos();
                
                $listaPermisosUsuarioORol=[];
                $listaPermisosUsuarioPorRol=[];
                // añadirPermisosOpcionesMenuFila();
                
                if(isset($filtros['ftextoUsuario']) && $filtros['ftextoUsuario'] != 0){
                    $usuario=$filtros['ftextoUsuario'];
                    $listaPermisosUsuarioORol=$this->modelo->buscarPermisosUsuario($usuario);

                    $rolesUsuario = $this->modelo->buscarRolesUsuario($filtros['ftextoUsuario']);
                    foreach ($rolesUsuario as $rol) {
                        $permisosRol = $this->modelo->buscarPermisosRol($rol['id']);
                        foreach ($permisosRol as $permiso){
                            $listaPermisosUsuarioPorRol[] = array($permiso, $rol);
                        }
                    }
                } else {
                    $usuario=0;
                }
                if(isset($filtros['ftextoRol']) && $filtros['ftextoRol'] != 0){
                    $rol=$filtros['ftextoRol'];
                    $listaPermisosUsuarioORol=$this->modelo->buscarPermisosRol($rol);
                } else {
                    $rol=0;
                }

                // echo '<pre>';
                // print_r($listaPermisosUsuarioORol);
                // echo '</pre>';

                // echo '<pre>';
                // print_r($listaPermisosUsuarioPorRol);
                // echo '</pre>';

                Vista::render('vistas/menu/V_Menu_Listado.php',array('opcionesMenu'=>$opcionesMenu, 'usuario'=>$usuario, 'rol'=>$rol, 'permisos'=>$permisos, 'listaPermisosUsuarioORol'=>$listaPermisosUsuarioORol, 'listaPermisosUsuarioPorRol'=>$listaPermisosUsuarioPorRol));
            } else {
                echo 'No se puede realizar la búsqueda por Usuario y Rol al mismo tiempo';
            }
        }

        public function getVistaNuevoEditar($datos=array()){
            if(!isset($datos['id']) || $datos['id']==''){
                //nuevo
                $nivel = $datos['nivel'];
                $padre_id = $datos['padre_id'];
                $orden = $datos['orden'];
                Vista::render('./vistas/menu/V_Menu_NuevoEditar.php', array('nivel'=>$nivel, 'padre_id'=>$padre_id, 'orden'=>$orden));
            } else {
                //editando
                $filtros['id']=$datos['id'];
                $opcionMenu=$this->modelo->buscarOpcionesMenu($filtros);
                // $opcionMenu[0]['hijo']=$datos['hijo'];
                
                Vista::render('./vistas/menu/V_Menu_NuevoEditar.php', array('opcionMenu'=>$opcionMenu[0]));
            }
        }

        public function getVistaNuevoEditarFila($datos=array()){
            $newTr = $datos['newTr'];
            if(!isset($datos['id']) || $datos['id']==''){
                //nuevo
                $nivel = $datos['nivel'];
                $padre_id = $datos['padre_id'];
                $orden = $datos['orden'];
                Vista::render('./vistas/menu/V_Menu_NuevoEditarFila.php', array('nivel'=>$nivel, 'padre_id'=>$padre_id, 'orden'=>$orden, 'newTr'=>$newTr));
            } else {
                //editando
                $filtros['id']=$datos['id'];
                $opcionMenu=$this->modelo->buscarOpcionesMenu($filtros);
                // $opcionMenu[0]['hijo']=$datos['hijo'];
                
                Vista::render('./vistas/menu/V_Menu_NuevoEditarFila.php', array('opcionMenu'=>$opcionMenu[0], 'newTr'=>$newTr));
            }
        }

        public function guardarOpcionMenu($datos=array()){
            $respuesta['correcto']='S';
            $respuesta['msj']='Creado correctamente.';

            // echo 'IDD: '.$datos['id'];

            if(isset($datos['id']) && $datos['id'] !== null && $datos['id'] !== ''){
                // echo "<script>console.log(\"Opcion Menu Editada\")</script>";
                $id=$this->modelo->editarOpcionMenu($datos);
            } else {
                // echo "<script>console.log(\"Opcion Menu Insertada\")</script>";
                $this->modelo->actualizarOpcionesPorDebajoMenu($datos);
                $id=$this->modelo->insertarOpcionMenu($datos);
            }


            if($id>0){
                //nada, ok
            } else {
                $respuesta['correcto']='N';
                $respuesta['msj']='Error al crear.';
            }
            echo json_encode($respuesta);
        }

        public function guardarOpcionMenuFila($datos=array()){
            $respuesta['correcto']='S';
            $respuesta['msj']='Creado correctamente.';

            if(isset($datos['id']) && $datos['id'] !== null && $datos['id'] !== ''){
                // echo "<script>console.log(\"Opcion Menu Editada\")</script>";
                $id=$this->modelo->editarOpcionMenu($datos);
            } else {
                // echo "<script>console.log(\"Opcion Menu Insertada\")</script>";
                $this->modelo->actualizarOpcionesPorDebajoMenu($datos);
                $id=$this->modelo->insertarOpcionMenu($datos);
            }


            if($id>0){
                //nada, ok
            } else {
                $respuesta['correcto']='N';
                $respuesta['msj']='Error al crear.';
            }
            echo json_encode($id);
        }

        public function guardarPermisoOpcionMenuFila($datos=array()){
            $respuesta['correcto']='S';
            $respuesta['msj']='Creado correctamente.';

            switch($datos['accion']){
                case 'insertar':
                    $id=$this->modelo->insertarPermisoOpcionMenu($datos);
                    if($id>0){
                        //nada, ok
                    } else {
                        $respuesta['correcto']='N';
                        $respuesta['msj']='Error al crear.';
                    }
                    // echo json_encode($id);
                    break;
                case 'editar':
                    $this->modelo->editarPermisoOpcionMenu($datos);
                    break;
                case 'eliminar':
                    $this->modelo->eliminarPermisoOpcionMenu($datos);
                    break;
            }

            echo json_encode($this->modelo->getPermisosOpcionMenu($datos['id_Menu']));

            // if(isset($datos['id']) && $datos['id'] !== null && $datos['id'] !== ''){
            //     // echo "<script>console.log(\"Opcion Menu Editada\")</script>";
            //     $id=$this->modelo->editarOpcionMenu($datos);
            // } else {
            //     // echo "<script>console.log(\"Opcion Menu Insertada\")</script>";
            //     $this->modelo->actualizarOpcionesPorDebajoMenu($datos);
            //     $id=$this->modelo->insertarPermisoOpcionMenu($datos);
            // }
        }

        // public function getPermisosOpcionMenuFila($id, $permisos){
        //     require_once 'vistas\menu\V_Menu_PermisosOpcionfila.php';
        //     $V_Menu_PermisosOpcionfila = new V_Menu_PermisosOpcionfila()
        // }

        public function actualizarUsuarioORolPorPermiso($datos=array()){
            $this->modelo->actualizarUsuarioConPermiso($datos);
        }

        public function guardarRol($datos=array()){
            $respuesta['correcto']='S';
            $respuesta['msj']='Creado correctamente.';

            // if(isset($datos['id']) && $datos['id'] !== null && $datos['id'] !== ''){
            //     $id=$this->modelo->editarRol($datos);
            // } else {
            //     $id=$this->modelo->crearRol($datos);
            // }

            switch ($datos['accion']){
                case 'crear':
                    $id=$this->modelo->crearRol($datos);
                    break;
                case 'editar':
                    $id=$this->modelo->editarRol($datos);
                    break;
                case 'eliminar':
                    $id=$this->modelo->eliminarRol($datos);
                    break;
            }


            if($id>0){
                //nada, ok
            } else {
                $respuesta['correcto']='N';
                $respuesta['msj']='Error al crear.';
            }
            echo json_encode($respuesta);
        }

        public function getRoles(){
            echo json_encode($this->modelo->obtenerRoles());
        }

        public function getRolesUsuario($datos){
            echo json_encode($this->modelo->buscarRolesUsuario($datos['id']));
        }

        public function getPermisosVisitanteSesion(){
            $permisosVisitante = $this->modelo->buscarPermisosRol(1);
                foreach($permisosVisitante as $permiso){
                    $permisosUsuarioSesion[] = $permiso;
                }

            // echo '<pre>';
            // print_r($permisosVisitante);
            // echo '</pre>';

            return $permisosVisitante;
        }

        public function obtenerPermisosRol($id){
            $permisosRol = $this->modelo->obtenerPermiso($id);
            // foreach($permisosRol as $permiso){
            //     $permisosRolSesion[] = $permiso;
            // }
            return $permisosRol;
        }

        public function getPermisosUsuarioSesion($datos){
            $permisosUsuarioSesion = $this->modelo->buscarPermisosUsuario($datos['id']);
            $rolesUsuario = $this->modelo->buscarRolesUsuario($datos['id']);
            foreach($rolesUsuario as $rol){
                $permisosRol = $this->modelo->buscarPermisosRol($rol['id']);
                foreach($permisosRol as $permiso){
                    $permisosUsuarioSesion[] = $permiso;
                }
            }

            $permisosVisitante = $this->modelo->buscarPermisosRol(1);
                foreach($permisosVisitante as $permiso){
                    $permisosUsuarioSesion[] = $permiso;
                }

            foreach($permisosUsuarioSesion as $permiso){
                $permisosUsuarioSesionFinal[] = $this->modelo->obtenerPermiso($permiso['id_Permiso'])[0];
            }

            usort($permisosUsuarioSesionFinal, function($a, $b) {
                return $a['id'] <=> $b['id'];
            });

            $unique = [];
            foreach ($permisosUsuarioSesionFinal as $item) {
                if (!isset($unique[$item['id']])) {
                    $unique[$item['id']] = $item;  // Store the item using 'id' as the key
                }
            }

            $permisosUsuarioSesionFinal = $unique;

            echo '<pre>';
            print_r($permisosUsuarioSesionFinal);
            echo '</pre>';

            return $permisosUsuarioSesionFinal;
        }

        // public function getRoles(){
        //     echo json_encode($this->modelo->obtenerRoles());
        // }

        // public function getPermisosUsuario($datos){
        //     echo json_encode($this->modelo->buscarPermisosUsuario($datos['id']));
        // }

        // public function getPermisosRol($datos){
        //     echo json_encode($this->modelo->buscarPermisosRol($datos['id']));
        // }

        // public function getRolesUsuario($datos){
        //     echo json_encode($this->modelo->buscarRolesUsuario($datos['id']));
        // }
    }
?>