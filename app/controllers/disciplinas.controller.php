<?php
    require_once "app/models/disciplinas.model.php";
    require_once "app/views/disciplinas.view.php";

    class DisciplinasController{
        private $model;
        private $view;

        public function __construct(){
            $this->model=new DisciplinaModel();
            $this->view=new DisciplinasView();
        }

        public function mostrarDisciplinas($navUrl){
            $disciplinas=$this->model->getDisciplinas();

            return $this->view->mostrarDisciplinas($disciplinas,$navUrl);
        }

        public function mostrarDisciplinasByIdClub($id,$navUrl){
            $disciplinasByClub=$this->model->getDisciplinasByClub($id);

            return $this->view->mostrarDisciplinasByClub($disciplinasByClub,$navUrl,$id);
        }


    }