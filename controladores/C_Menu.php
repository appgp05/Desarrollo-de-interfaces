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
            Vista::render('./vistas/menu/V_Menu_Filtros.php',array('usuarios'=>$usuarios), array('roles'=>$roles));
        }

        public function getVistaListadoOpcionesMenu($filtros=array()){
            // var_dump($filtros);
            $opcionesMenu=$this->modelo->buscarOpcionesMenu($filtros);
            // añadirPermisosOpcionesMenuFila();
            Vista::render('vistas/menu/V_Menu_Listado.php',array('opcionesMenu'=>$opcionesMenu));
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
    }
?>