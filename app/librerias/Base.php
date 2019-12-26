<?php

class Base{

    private $usuario = DB_USUARIO;
    private $contrasena = DB_CLAVE;  
    private $servidor = DB_HOST;
    private $basededatos = DB_NOMBRE;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        
        $dns='mysql:host='.$this->servidor.';dbname='.$this->basededatos;

        $opciones = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        //crea una instancia pdo
        try {
            $this->dbh = new PDO($dns, $this->usuario,$this->contrasena ,$opciones);
            $this->dbh->exec('set names utf8');
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }

    }

    public function query($sql){

        $this->stmt = $this->dbh->prepare($sql);

    }

    //vinculacion de la consulta a bind
    public function bind($parametro, $valor, $tipo = null){

        if (is_null($tipo)){

            switch (true){
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                break;
                case is_null($valor):
                    $tipo = PDO::PARAM_NULL;
                break;
                default:
                    $tipo = pdo::PARAM_STR;
            break;

            }
        }

        $this->stmt->bindvalue($parametro, $valor, $tipo);
    }

    //funcion que ejecuta la consulta
    public function execute(){
        return $this->stmt->execute();
    }


    public function registros(){
        $this->execute();
        return $this->stmt->fetchALL(PDO::FETCH_OBJ);
    }


    public function registro(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //obtener la cantidad de objetos
    public function rowCount(){
       
        return $this->stmt->rowCount();
    }

}