<?php

class pgns extends Controlador {

    public function __construct()
    {
        //echo 'controlador paginas cargar';
        //$this->articuloModelo = $this->modelo('Articulo');
    } 

    public function index(){

       // $articulos = $this->articuloModelo->getArticulos();
 
        $datos= [
            'titulo' => 'Bienvenidos al framework MVC'
        ];

        $this->vista('pgns/inicio',$datos);
    }

}