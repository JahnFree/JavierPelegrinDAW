<?php
namespace App;
session_start();
use App\Controller\usuarioController;
$public = '/cms/public/';
require('../view/partials/header.php');
$home = '/cms/public/index.php/';
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

if ($ruta == 'panel'){
    $controller =  new usuarioController;
    
    $controller->acceso();
            
}

require('../view/partials/footer.php');

