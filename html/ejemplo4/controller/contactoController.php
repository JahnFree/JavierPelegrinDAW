<?php

class contactoController {
    
    public function index(){
                
        $contacto = new Contacto("Javier", "Pelegrin de Paz", 19, "");

        $contacto->setEmail("javipdp98@gmail.com");

        require("view/index.php"); 
        
    }
    
}