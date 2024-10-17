<?php
    require_once 'app/models/deploy.model.php';

    class AuthModel extends Model{

        public function getUserByEmail($email){
            $query=$this->db->prepare("SELECT * FROM usuario WHERE email=?");
            $query->execute([$email]);

            $user=$query->fetch(PDO::FETCH_OBJ);

            return $user;
        }
    }