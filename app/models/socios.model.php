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

        public function getSocioById($id){
            $query=$this->db->prepare('SELECT * FROM socios WHERE id_socio=?');
            $query->execute([$id]);

            $socio=$query->fetch(PDO::FETCH_OBJ);
            
            return $socio;
        }

        public function getSociosByClub($id){
            $query=$this->db->prepare('SELECT * FROM socios WHERE id_club=?');
            $query->execute([$id]);

            $socios=$query->fetchAll(PDO::FETCH_OBJ);
            
            return $socios;
        }

        public function addSocio($nombre,$apellido,$dni,$id_club){
            $query=$this->db->prepare('INSERT INTO socios(nombre,apellido,dni,id_club) VALUES (?,?,?,?)');
            $query->execute([$nombre,$apellido,$dni,$id_club]);

            $id=$this->db->lastInsertId();

            return $id;
        }

        public function deleteSocio($id){
            $query=$this->db->prepare('DELETE FROM socios WHERE id_socio=?');
            $query->execute([$id]);

            return;
        }

        public function updateSocio($id,$nombre,$apellido,$dni){
            $query=$this->db->prepare("UPDATE socios SET nombre=?, apellido=?, dni=? WHERE id_socio=?");
            $query->execute([$nombre,$apellido,$dni,$id]);
            
            return;
        }


    }