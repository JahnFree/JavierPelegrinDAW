<?php
namespace App\Controller;
use App\Model\contacto;
use App\Helper\viewHelper;
class contactoController {
    
    public function index(){
                
        $contacto = new contacto("Javier", "Pelegrin de Paz", 19, "");

        $contacto->setEmail("javipdp98@gmail.com");
        
        $view = new viewHelper();

        $view->vista("index",$contacto); 
        
    }
    
}

