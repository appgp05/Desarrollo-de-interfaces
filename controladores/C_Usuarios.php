<?php
    require_once './controladores/Controlador.php';
    require_once './modelos/M_Usuarios.php';
    require_once './vistas/Vista.php';
    class C_Usuarios extends Controlador{
        private $modelo;

        public function __construct(){
            parent::__construct();
            $this->modelo = new M_Usuarios();
        }

        public function validarUsuario($datos = array()) {
            $id_Usuario=$this->modelo->login($datos);
            return $id_Usuario;
        }

        public function getVistaFiltros($datos=array()){
            Vista::render('./vistas/usuarios/V_Usuarios_Filtros.php');
        }

        public function getVistaNuevoEditar($datos=array()){
            if(!isset($datos['id']) || $datos['id']==''){
                //nuevo
                Vista::render('./vistas/usuarios/V_Usuarios_NuevoEditar.php');
            } else {
                //editando
                $filtros['id_Usuario']=$datos['id'];
                $usuarios=$this->modelo->buscarUsuarios($filtros);
                Vista::render('./vistas/usuarios/V_Usuarios_NuevoEditar.php',array('usuario'=>$usuarios[0]));
            }
        }

        public function getVistaListadoUsuarios($filtros=array()){
            // var_dump($filtros);
            $usuarios=$this->modelo->buscarUsuarios($filtros);
            Vista::render('vistas/Usuarios/V_Usuarios_Listado.php',array('usuarios'=>$usuarios));
        }

        public function guardarUsuario($datos=array()){
            $respuesta['correcto']='S';
            $respuesta['msj']='Guardado correctamente.';

            // session_start();
            // $permisosSesion = array_map('strtolower', array_column($_SESSION['permisosSesion'], 'permiso'));

            if( isset($datos['id_Usuario']) && $datos['id_Usuario'] !== null && $datos['id_Usuario'] !== ''){
                // echo "<script>console.log(\"Usuario Editado\")</script>";

                // echo '<pre>';
                // print_r($permisosSesion);
                // echo '</pre>';

                // $permisoBuscado = 'añadirusuario';

                // if (in_array($permisoBuscado, $permisosSesion)) {
                    // echo "asdhkahjkisdfkndfgddd dddddddddddd";
                    $id=$this->modelo->editarUsuario($datos);
                // }
            } else {
                // echo "<script>console.log(\"Usuario Insertado\")</script>";

                // $permisoBuscado = 'editarusuario';

                // if (in_array($permisoBuscado, $permisosSesion)) {
                    $id=$this->modelo->insertarUsuario($datos);
                // }
            }


            if($id>0){
                //nada, ok
            } else {
                $respuesta['correcto']='N';
                $respuesta['msj']='Error al crear.';
            }
            echo json_encode($respuesta);
        }

        // public function editarUsuario($datos=array()){
        //     $id= $this->modelo->editarUsuario($datos);
        //     if($id>0){
        //         //nada, ok
        //     } else {
        //         $respuesta['correcto']='N';
        //         $respuesta['msj']='Error al editar.';
        //     }
        //     echo json_encode($respuesta);
        // }

        public function cambiarEstadoUsuario($datos=array()){
            $this->modelo->cambiarEstadoUsuario($datos);
        }
    }
?>