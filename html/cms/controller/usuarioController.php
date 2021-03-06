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

    public function acceso() {
        $datos = new \stdClass();
        if (isset($_SESSION['usuario']) AND $_SESSION['usuario']) {
            $datos->usuario = $_SESSION['usuario'];
            $vista = "panel";
        } else {
            $vista = "acceso";
        }
        $datos->mensaje = "Por favor, introduce usuario y contraseña";
        if (isset($_POST['acceso'])) {
            $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
            $clave = filter_input(INPUT_POST, 'clave', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($usuario AND $clave) {
                if ($this->comprueba_usuario($usuario, $clave)) {
                    $datos->usuario = $_SESSION['usuario'];
                    $vista = "panel";
                } else {
                    $datos->mensaje = "<span class='rojo'>Usuario o clave incorrecto<br>Vuelve a intentarlo</span>";
                }
            }
        }
        $this->view->vista($vista, $datos);
    }

    function comprueba_usuario($usuario, $clave) {
        $resultado = $this->db->query("SELECT * FROM usuarios WHERE usuario='" . $usuario . "'");
        $data = $resultado->fetch(\PDO::FETCH_OBJ);
        if ($data AND hash_equals($data->clave, crypt($clave, $data->clave))) {
            $_SESSION['usuario'] = $data->usuario;
            return 1;
        } else {
            return 0;
        }
    }

    public function index() {
        //Select con OBJ
        $resultado = $this->db->query("SELECT * FROM usuarios");
        //Asigno la consulta a una variable
        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)) { //Recorro el resultado
            $usuarios[] = new Usuario($data);
        }

        //Le paso los datos
        $this->view->vista("usuarios", $usuarios);
    }

    public function salir() {
        $_SESSION['usuario'] = "";
        header("location: " . $_SESSION['home'] . "panel");
        $this->acceso();
    }

    public function crear() {

        $nombre = "usuario" . rand(1000, 9999);
        $registros = $this->db->exec('INSERT INTO usuarios (usuario) VALUES ("' . $nombre . '")');
        if ($registros) {
            $mensaje[] = ['tipo' => 'succes',
                'texto' => 'El usuario se ha añadido correctamente'];
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => 'Ha ocurrido un error al añadir el usuario'];
        }
        $_SESSION['mensajes'] = $mensaje;
        header("location: " . $_SESSION['home'] . "panel/usuarios");
    }

    function activar($id) {

        if ($id) {
            $registros = $this->db->exec("UPDATE usuarios SET activo=1 WHERE id='" . $id . "'");
            if ($registros) {
                $mensaje[] = ['tipo' => 'succes',
                    'texto' => 'El usuario se ha activado correctamente'];
            } else {
                $mensaje[] = ['tipo' => 'danger',
                    'texto' => 'Ha ocurrido un error al activar el usuario'];
            }
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => 'Ha ocurrido un error al activar el usuario'];
        }
        $_SESSION['mensajes'] = $mensaje;
        header("location: " . $_SESSION['home'] . "panel/usuarios");
    }

    function desactivar($id) {

        if ($id) {
            $registros = $this->db->exec("UPDATE usuarios SET activo=0 WHERE id='" . $id . "'");
            if ($registros) {
                $mensaje[] = ['tipo' => 'succes',
                    'texto' => 'El usuario se ha desactivado correctamente'];
            } else {
                $mensaje[] = ['tipo' => 'danger',
                    'texto' => 'Ha ocurrido un error al desactivar el usuario'];
            }
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => 'Ha ocurrido un error al desactivar el usuario'];
        }
        $_SESSION['mensajes'] = $mensaje;
        header("location: " . $_SESSION['home'] . "panel/usuarios");
    }

    function borrar($id) {

        if ($id) {
            $registros = $this->db->exec("DELETE FROM usuarios WHERE id='" . $id . "'");
            if ($registros) {
                $mensaje[] = ['tipo' => 'succes',
                    'texto' => 'El usuario se ha borrado correctamente'];
            } else {
                $mensaje[] = ['tipo' => 'danger',
                    'texto' => 'Ha ocurrido un error al borrado el usuario'];
            }
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => 'Ha ocurrido un error al borrar el usuario'];
        }
        $_SESSION['mensajes'] = $mensaje;
        header("location: " . $_SESSION['home'] . "panel/usuarios");
    }

    function editar($id) {

        if ($id) {
            if(isset($_POST['guardar']) AND  $_POST['guardar'] == "guardar"){
                $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $usuarios = (filter_input(INPUT_POST, 'usuarios', FILTER_SANITIZE_STRING)) == 'on' ? 1 : 0;
                $noticias = (filter_input(INPUT_POST, 'noticias', FILTER_SANITIZE_STRING)) == 'on' ? 1 : 0;
                $this->db->beginTransaction();
                $this->db->exec("UPDATE usuarios SET usuario='".$usuario."' WHERE id='".$id."'");
                $this->db->exec("UPDATE usuarios SET usuarios='".$usuarios."' WHERE id='".$id."'");
                $this->db->exec("UPDATE usuarios SET noticias='".$noticias."' WHERE id='".$id."'");
                $this->db->commit();
                
                $mensaje[] = ['tipo' => 'succes',
                    'texto' => 'El usuario <strong>'.$usuario.'</strong> se ha editado correctamente'];
                header("location: " . $_SESSION['home'] . "panel/usuarios");
                
            }else{
               $resultado = $this->db->query("SELECT * FROM usuarios WHERE id='" . $id . "'");
                $usuario = $resultado->fetch(\PDO::FETCH_OBJ);
                if ($usuario) {
                    $this->view->vista('editar_usuario', $usuario);
                } else {
                    $mensaje[] = ['tipo' => 'danger',
                        'texto' => 'Ha ocurrido un error al editar el usuario'];
                    $_SESSION['mensajes'] = $mensaje;
                    header("location: " . $_SESSION['home'] . "panel/usuarios");
                } 
            }           
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => 'Ha ocurrido un error al editar el usuario'];
            $_SESSION['mensajes'] = $mensaje;
            header("location: " . $_SESSION['home'] . "panel/usuarios");
        }
    }

}
