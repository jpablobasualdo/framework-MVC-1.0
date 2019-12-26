<?php

class Controlador{
    
    //cargar modelo
    public function modelo($modelo){
        require_once '../app/modelos/'.$modelo.'.php';

        //instanciar
        return new $modelo();
    }

        //cargar cista
    public function vista($vista, $datos=[]){

        //validar si el archivo vista existe
        if (file_exists('../app/vistas/'.$vista.'.php')){

            require_once '../app/vistas/'.$vista.'.php';
        } else {
                die('la vista no existe');
        }
    }
}