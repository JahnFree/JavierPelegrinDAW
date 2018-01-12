<?php

class contacto{
    var $nombre;
    var $apellidos;
    var $edad;
    var $email;
    
    function setNombre($elnombre){
        
        $this->nombre = $elnombre;
    }
    
    function getNombre(){
        return $this->nombre;
    }
}

$mi_contacto = new contacto();

$mi_contacto->setNombre("Javier");
echo "El contacto se llama ". $mi_contacto->getNombre();
?>
