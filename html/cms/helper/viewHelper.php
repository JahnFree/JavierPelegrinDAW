<?php

namespace App\Helper;

class viewHelper {
    
    public function vista($vista,$datos){
        
        $archivo = "../view/$vista.php";
        require($archivo);
    }
    
}
