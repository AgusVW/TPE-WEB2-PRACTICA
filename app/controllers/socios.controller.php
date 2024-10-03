<?php
    require_once "app/models/socios.model.php";
    require_once "app/views/socios.view.php";

    class SociosController{
        private $model;
        private $view;

        public function __construct() {
            $this->model=new SociosModel();
            $this->view=new SociosView();
        }

        public function mostrarSocios($navUrl){
            $socios=$this->model->getSocios();

            return $this->view->mostrarSocios($socios,$navUrl);
        }

        public function mostrarSociosByIdClub($id,$navUrl){
            $sociosByClub=$this->model->getSociosByClub($id);

            return $this->view->mostrarSociosByIdClub($sociosByClub,$navUrl,$id);
        }
    }
