<?php 
    require_once 'app/models/deploy.model.php';

    class DisciplinaModel extends Model{

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

        public function getDisciplinaById($id){
            $query=$this->db->prepare('SELECT * FROM disciplina WHERE id_disciplina=?');
            $query->execute([$id]);

            $disciplinas=$query->fetch(PDO::FETCH_OBJ);

            return $disciplinas;
        }

        public function addDisciplina($deporte,$direccion,$contacto,$id_club){
            $query=$this->db->prepare('INSERT INTO disciplina(deporte,direccion,contacto,id_club) VALUES (?,?,?,?)');
            $query->execute([$deporte,$direccion,$contacto,$id_club]);

            $id=$this->db->lastInsertId();

            return $id;
        }

        public function deleteDisciplina($id){
            $query=$this->db->prepare('DELETE FROM disciplina WHERE id_disciplina=?');
            $query->execute([$id]);

            return;
        }

        public function updateDisciplina($id,$deporte,$direccion,$contacto){
            $query=$this->db->prepare("UPDATE disciplina SET deporte=?, direccion=?, contacto=? WHERE id_disciplina=?");
            $query->execute([$deporte,$direccion,$contacto,$id]);
            
            return;
        }
    }