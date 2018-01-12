<?php

class contacto {
    var $nombre;
    var $apellidos;
    var $edad;
    var $email;

    function __construct($elnombre,$elapellido,$laead,$elemail){
        $this->nombre = $elnombre;
        $this->apellidos = $elapellido;
        $this->edad = $laead;
        $this->email = $elemail;
                
    }
    
    function setEmail($elemail){
        return $this->email;
    }
}
