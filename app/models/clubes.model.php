<?php
    require_once 'app/models/deploy.model.php';

    class ClubesModel extends Model{
        
        public function getClubes(){
            $query=$this->db->prepare('SELECT * FROM club');
            $query->execute();

            $clubes=$query->fetchAll(PDO::FETCH_OBJ);

            return $clubes;
        }

        public function getClubById($id){
            $query=$this->db->prepare('SELECT * FROM club WHERE id_club = ? ');
            $query->execute([$id]);

            $club=$query->fetch(PDO::FETCH_OBJ);

            return $club;
        }

        public function addClub($club,$localidad,$fundacion,$sede,$contacto){
            $query=$this->db->prepare('INSERT INTO club(club,fundacion,localidad,sede,contacto) VALUES (?,?,?,?,?)');
            $query->execute([$club,$fundacion,$localidad,$sede,$contacto]);

            $id=$this->db->lastInsertId();

            return $id;
        }

        public function deleteClub($id){
            $query=$this->db->prepare('DELETE FROM club WHERE id_club=?');
            $query->execute([$id]);

            return;
        }

        public function updateClub($id,$club,$fundacion,$localidad,$sede,$contacto){
            $query=$this->db->prepare("UPDATE club SET club=?, fundacion=?, localidad=?, sede=?, contacto=? WHERE id_club=?");
            $query->execute([$club,$fundacion,$localidad,$sede,$contacto,$id]);
            
            return;
        }
    }