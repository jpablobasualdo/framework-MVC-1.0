<?php

//cargamos las librerias
require_once 'config/config.php';



//autoload me permite cargar todas las clases de la carpeta libreria
spl_autoload_register(function($nombreClase){

    require_once 'librerias/'.$nombreClase.'.php';

});