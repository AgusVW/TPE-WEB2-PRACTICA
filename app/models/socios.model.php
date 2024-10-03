<?php
    class SociosModel{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=sistema_clubes;charset=utf8', 'root', '');        
        }

        public function getSocios(){
            $query=$this->db->prepare('SELECT * FROM socios');
            $query->execute();

            $socios=$query->fetchAll(PDO::FETCH_OBJ);
            
            return $socios;
        }

        public function getSociosByClub($id){
            $query=$this->db->prepare('SELECT * FROM socios WHERE id_club=?');
            $query->execute([$id]);

            $socios=$query->fetchAll(PDO::FETCH_OBJ);
            
            return $socios;
        }


    }