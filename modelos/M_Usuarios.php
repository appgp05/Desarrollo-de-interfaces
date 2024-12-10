<?php
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
class M_Usuarios extends Modelo{
    public $DAO;

    public function __construct(){
        parent::__construct(); //ejecutar constructor padre
        $this->DAO = new DAO();
    }

    public function login($datos){
        $usuario='fsfsfsfs';
        $pass='dfsdfsdfs';
        extract($datos);
        $pass = md5($pass);
        echo "usuario: ".$usuario." pass:".$pass;
        $usuario=addslashes($usuario);
        $SQL="SELECT * FROM usuarios WHERE login='$usuario' && pass='$pass'";
        $usuarios=$this->DAO->consultar($SQL);

        // echo $SQL;
        $id_Usuario='';

        if(empty($usuarios)){

        } else {
            $_SESSION['login']=$usuario;
            $_SESSION['usuario']=$usuarios[0]['nombre'];
            $_SESSION['id_Usuario']=$usuarios[0]['id_Usuario'];
            $id_Usuario=$usuarios[0]['id_Usuario'];
        }
        return $id_Usuario;
    }

    public function buscarUsuarios($filtros=array()){
        $ftexto="";
        $factivo="";
        $id_Usuario="";
        extract($filtros);
        
        
        $SQL="SELECT * FROM usuarios WHERE 1=1";
        

        if($ftexto!=""){
            $aPalabras=explode(' ',$ftexto);

            $SQL.=" AND 1 = 2";

            foreach($aPalabras as $word){
                    $SQL.=" OR (nombre LIKE '%$word%'
                OR apellido_1 LIKE '%$word%'
                OR apellido_2 LIKE '%$word%')";
            }
        }

        if($factivo!=''){
            $SQL.=" AND activo='$factivo' ";
        }
        if($id_Usuario!=''){
            $SQL.=" AND id_Usuario='$id_Usuario' ";
        }

        $SQL.=' ORDER BY apellido_1, apellido_2, nombre, login ';

        $usuarios = $this->DAO->consultar($SQL);
        

        return $usuarios;
    }

    public function insertarUsuario($datos=Array()){
        $nombre='';
        $apellido_1='';
        $apellido_2='';
        $sexo='H';
        $fecha_Alta=date('Y-m-d');
        $mail='';
        $movil='';
        $login='asddsadasdsa';
        $pass='dasdsdsadsadas';
        $activo='S';
        extract($datos);

        $pass=MD5($pass);
        
        $SQL="INSERT INTO usuarios SET
                nombre='$nombre',
                apellido_1='$apellido_1',
                apellido_2='$apellido_2',
                sexo='$sexo',
                fecha_Alta='$fecha_Alta',
                mail='$mail',
                movil='$movil',
                login='$login',
                pass='$pass',
                activo='$activo'";
        return $this->DAO->insertar($SQL);
    }

    public function editarUsuario($datos=Array()){
        $id_Usuario='';
        $nombre='';
        $apellido_1='';
        $apellido_2='';
        $sexo='H';
        $fecha_Alta=date('Y-m-d');
        $mail='';
        $movil='';
        $login='asddsadasdsa';
        $pass='dasdsdsadsadas';
        $activo='S';
        extract($datos);

        $pass=MD5($pass);
        
        $SQL="UPDATE usuarios SET
                nombre='$nombre',
                apellido_1='$apellido_1',
                apellido_2='$apellido_2',
                sexo='$sexo',
                fecha_Alta='$fecha_Alta',
                mail='$mail',
                movil='$movil',
                login='$login',
                pass='$pass',
                activo='$activo'
                WHERE id_Usuario = '$id_Usuario'";
        return $this->DAO->actualizar($SQL);
    }

    public function cambiarEstadoUsuario($datos=Array()){
        $id_Usuario=0;
        extract($datos);

        $SQL = "UPDATE `usuarios` SET `activo` = CASE WHEN `activo` = 'N' THEN 'S' ELSE 'N' END WHERE `id_Usuario` = '$id_Usuario';";
        $this->DAO->actualizar($SQL);
    }
}
?>