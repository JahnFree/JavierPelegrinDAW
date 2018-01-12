<?php

require ("contacto.php");

$mi_contacto = new contacto("Javier", "Pelegrin de Paz", 19,"email");

$mi_contacto->email = "prueba@gmail.com";

echo "El contacto se llama ".$mi_contacto->nombre." ".$mi_contacto->apellidos," y su email es ".
        $mi_contacto->email;

