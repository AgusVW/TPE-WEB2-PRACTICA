<?php 
    class DisciplinaModel{
        private $db;

        public function __construct(){
            $this->db=new PDO('mysql:host=localhost;dbname=sistema_clubes;charset=utf8', 'root', ''); 
        }

        public function getDisciplinas(){
            $query=$this->db->prepare('SELECT * FROM disciplina');
            $query->execute();

            $disciplinas=$query->fetchAll(PDO::FETCH_OBJ);

            return $disciplinas;
        }

        public function getDisciplinasByClub($id){
            $query=$this->db->prepare('SELECT * FROM disciplina WHERE id_club=?');
            $query->execute([$id]);

            $disciplinas=$query->fetchAll(PDO::FETCH_OBJ);

            return $disciplinas;
        }
    }