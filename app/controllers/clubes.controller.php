<?php
    require_once "app/models/clubes.model.php";
    require_once "app/models/socios.model.php";
    require_once "app/models/disciplinas.model.php";
    require_once "app/views/clubes.view.php";

    class ClubesController{
        private $view;
        private $modelClub;
        private $modelSocio;
        private $modelDisciplina;

        public function __construct(){
            $this->view=new ClubesView;
            $this->modelClub=new ClubesModel;
            $this->modelSocio=new SociosModel;
            $this->modelDisciplina=new DisciplinaModel;
        }

        public function mostrarClubes($navUrl){
            $clubes=$this->modelClub->getClubes();

            return $this->view->mostrarClubes($clubes,$navUrl);
        }

        public function obtenerClubById($idClub){
            $clubSocio=$this->modelClub->getClubById($idClub);

            return $clubSocio;
        }

        public function getClubCompleto($id,$navUrl){
            $club=$this->modelClub->getClubById($id);
            $socios=$this->modelSocio->getSociosByClub($id);
            $disciplinas=$this->modelDisciplina->getDisciplinasByClub($id);

            return $this->view->mostrarClubCompleto($club,$socios,$disciplinas,$navUrl);
        }

        
    }