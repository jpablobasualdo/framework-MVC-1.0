<?php

    class Articulo{

        private $db;

        public function __construct()
        {
            $this->db = new Base;
        }
     
        public function getArticulos(){

            $this->db->query('SELECT * FROM articulos');
            return $this->db->registros();

        }
    }