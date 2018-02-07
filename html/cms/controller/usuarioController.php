<?php
namespace App\Controller;
use App\Model\usuario;
use App\Helper\viewHelper;
use App\Helper\dbHelper;

class usuarioController {
    var $db;
    function __construct() {
        $dbHelper = new dbHelper();
        $this->db = $dbHelper->db; 
        $viewhelper = new viewHelper();
        $this->view = $viewhelper;
    }

    public function acceso(){
        $datos = new \stdClass();
        if(isset($_SESSION['usuario']) AND $_SESSION['usuario']){
            $datos->usuario = $_SESSION['usuario'];
            $vista = "panel";
        }else{
           $vista = "acceso"; 
        }             
        $datos->mensaje = "Por favor, introduce usuario y contraseña";
        if(isset($_POST['acceso'])){
            $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
            $clave = filter_input(INPUT_POST, 'clave', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if($usuario AND $clave){
                if($this->comprueba_usuario($usuario, $clave)){
                    $datos->usuario = $_SESSION['usuario'];
                    $vista = "panel";
                }else{
                    $datos->mensaje = "<span class='rojo'>Usuario o clave incorrecto<br>Vuelve a intentarlo</span>";
                }
            }
        }
        $this->view->vista($vista,$datos);
    }

    function comprueba_usuario($usuario, $clave){
        $resultado = $this->db->query("SELECT * FROM usuarios WHERE usuario='".$usuario."'");
        $data = $resultado->fetch(\PDO::FETCH_OBJ);
        if($data AND hash_equals($data->clave, crypt($clave, $data->clave))){
            $_SESSION['usuario'] = $data->usuario;
            return 1;
            
        }else{
            return 0;
        }
    }
    
    public function index(){        
        //Select con OBJ
        $resultado = $this->db->query("SELECT * FROM usuarios");
        //Asigno la consulta a una variable
        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)){ //Recorro el resultado
            $usuarios[] = new Usuario($data);
        }
        
        //Le paso los datos
        $this->view->vista("usuarios",$usuarios);
        
    }
    
    public function salir(){
        $_SESSION['usuario'] = "";
        header("location: ".$_SESSION['home']."panel");
        $this->acceso();
    }
    
    public function crear(){        
      
        $nombre = "usuario".rand(1000, 9999);
        $registros = $this->db->exec('INSERT INTO usuarios (usuario) VALUES ("'.$nombre.'")');
        if($registros){
            $mensaje[] = ['tipo'=>'succes',
                        'texto'=>'El usuario'.$nombre.'se ha añadido correctamente'];
        }else{
           $mensaje[] = ['tipo'=>'danger',
                        'texto'=>'Ha ocurrido un error al añadir el usuario']; 
        }
        $_SESSION['mensajes'] = $mensaje;
         header("location: ".$_SESSION['home']."panel/usuarios");
        
    }
    
    
}

