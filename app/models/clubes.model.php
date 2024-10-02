<?php
    class ClubesModel{
        private $db;

        public function __construct(){
            $this->db=new PDO('mysql:host=localhost;dbname=sistema_clubes;charset=utf8', 'root', '');
        }

        public function getClubes(){
            $query=$this->db->prepare('SELECT * FROM club');
            $query->execute();

            $clubes=$query->fetchAll(PDO::FETCH_OBJ);

            return $clubes;
        }
    }