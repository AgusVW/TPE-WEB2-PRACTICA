<?php
    class DisciplinasView{
        public function mostrarDisciplinas($disciplinas,$navUrl){
            require "templates/disciplinas.phtml";
        }

        public function mostrarDisciplinasByClub($disciplinasByClub,$navUrl,$id){
            require_once "templates/disciplinasPorClub.phtml";
        }
    }