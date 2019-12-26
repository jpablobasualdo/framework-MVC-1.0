<?php

class Core {

    protected $controladorActual = 'pgns';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct(){
        
        $url = $this->getUrl();

        //busca en los controladores si el controlador existe
        if  (file_exists('../app/controladores/'.ucwords($url[0]).'.php')) {
            //si existe setea el controlador por defecto
            $this->controladorActual = ucwords($url[0]);

            unset($url[0]);

        }

            require_once '../app/controladores/'.$this->controladorActual.'.php';
            $this->controladorActual = new $this->controladorActual;

        //verificar la seunda parte de la url que seria el metodo
        if (isset($url[1])){

            if (method_exists($this->controladorActual,$url[1])){
                //validar metodo

                $this->metodoActual = $url[1];
                unset($url[1]);
            }
        }

        //obtener los posibles parametros
        $this->parametros = $url ? array_values($url) : [];

        //llamar callback con parametros array
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);


    }


    public function getUrl(){
        //echo $_GET['url'];
        if (isset($_GET['url'])){

            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/',$url);

            return $url;
        }
    }


}