<?php

class contacto{
    var $nombre;
    var $apellidos;
    var $edad;
    var $email;
    
    /*constructor antiguo
    
    function contacto($elnombre,$elapellido,$laead,$elemail){
        $this->nombre = $elnombre;
        $this->apellidos = $elapellido;
        $this->edad = $laead;
        $this->email = $elemail;
                
    }
    
    constructor nuevo*/
    function __construct($elnombre,$elapellido,$laead,$elemail){
        $this->nombre = $elnombre;
        $this->apellidos = $elapellido;
        $this->edad = $laead;
        $this->email = $elemail;
                
    }
    
}
$mi_contacto = new contacto("Javier", "Pelegrin de Paz", 19,"email");

echo "El contacto se llama ".$mi_contacto->nombre." ".$mi_contacto->apellidos;


?>

