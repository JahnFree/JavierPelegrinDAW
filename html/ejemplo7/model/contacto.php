<?php
namespace App\Model;
class contacto{
   
    //Variables o atributos
    var $nombre;
    var $apellidos;
    var $edad;
    var $telefono;
    var $email;
    
    //Método constructor
    function __construct($nombre,$apellidos,$edad,$email){
        
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->edad = $edad;
        $this->email = $email;
        
    }
    
    //setEmail
    public function setEmail($email){
        $this->email = $email;
    }
    
    //getEmail
    public function getEmail(){
        return $this->email;
    }
    
}

