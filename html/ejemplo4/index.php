<?php

//Incluyo los archivos necesarios
require("./controller/contactoController.php");
require("./model/contacto.php");

//Instancio el controlador
$controller = new ContactoController;

//Ejecuto el método por defecto del controlador (podría hacer un construct)
$controller->index();