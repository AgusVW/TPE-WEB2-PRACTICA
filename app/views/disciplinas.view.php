<?php
    class DisciplinasView{
        private $user=null;

        public function __construct($user) {
            $this->user=$user;
        }
        
        public function mostrarDisciplinas($disciplinas,$navUrl="Disciplinas"){
            require "templates/disciplinas.phtml";
        }

        public function mostrarDisciplinasPorClub($disciplinasByClub,$id,$navUrl="Disciplinas"){
            require_once "templates/disciplinasPorClub.phtml";
        }

        public function mostrarEditarDisciplina($disciplina,$navUrl="Editar"){
            require_once "templates/formUpdate/formDisciplina.phtml";
        }

        public function mostrarError($error='',$navUrl="Error"){
            require_once "templates/error.phtml";
        }
    }