<?php
namespace App;
session_start();
use App\Controller\usuarioController;
$public = '/cms/public/';
require('../view/partials/header.php');
$home = '/cms/public/index.php/';
$_SESSION['home'] = $home;
$ruta = str_replace($home, '',$_SERVER['REQUEST_URI']);

//Defino la función que autocargará la clase cuando se instancie
spl_autoload_register('App\autoload');
 
function autoload($clase,$dir=null) {

    //Directorio raíz de mi proyecto (ruta absoluta)
    if (is_null($dir)){
        $dirname = str_replace('/public', '',dirname(__FILE__));
        $dir = realpath($dirname);
    }

    //Escaneo en busca de la clase de forma recursiva
    foreach (scandir($dir) as $file) {
        //Si es un directorio (y no es de sistema), busco la clase dentro de él
        if (is_dir($dir."/".$file) AND substr($file, 0, 1 ) !== '.'){
            autoload($clase, $dir."/".$file);
        }
        //Si es archivo y el nombre coincide con la clase
        else if (is_file($dir."/".$file) AND $file == substr(strrchr ($clase, "\\"), 1).".php"){
            //echo $clase.""; //para ver cuales ha cargado
            require($dir."/".$file);
        }

    }

}
$array_ruta = explode("/", $ruta);

if(count($array_ruta) == 4){
    if($array_ruta[0].$array_ruta[1] == "panelusuarios"){
        if($array_ruta[2] == "editar" OR $array_ruta[2] == "borrar" OR $array_ruta[2] == "activar" OR $array_ruta[2] == "desactivar"){
            $controller =  new usuarioController;
            $accion = $array_ruta[2];
            $id = $array_ruta[3];
            $controller->$accion($id);
        }else{
            $controller =  new appController;
            $controller->index();
        }
 
    }else if ($array_ruta[0].$array_ruta[1] == "panelnoticias"){
        if($array_ruta[2] == "editar" OR $array_ruta[2] == "borrar" OR $array_ruta[2] == "activar" OR $array_ruta[2] == "desactivar"){
            $controller =  new noticiaController;
            $accion = $array_ruta[2];
            $id = $array_ruta[3];
            $controller->$accion($id);
        }else{
            $controller =  new appController;
            $controller->index();
        }
    }else{
        $controller =  new appController;
        $controller->index();
    }
}else{

    switch ($ruta){
        case 'panel':
            $controller =  new usuarioController;
            $controller->acceso();
            break;
        case 'panel/salir':
            $controller =  new usuarioController;
            $controller->salir();
            break;
        case 'panel/usuarios':
            $controller =  new usuarioController;
            $controller->index();
            break;
        case 'panel/usuarios/crear':
            $controller =  new usuarioController;
            $controller->crear();
            break;
        case 'panel/noticias':
            $controller =  new noticiaController;
            $controller->index();
            break;
        case 'panel/noticias/crear':
            $controller =  new noticiaController;
            $controller->crear();
            break;
        default: $controller =  new appController;
                 $controller->crear();
    }
}

require('../view/partials/footer.php');

