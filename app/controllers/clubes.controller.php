<?php
    require_once "app/models/clubes.model.php";
    require_once "app/views/clubes.view.php";

    class ClubesController{
        private $view;
        private $model;

        public function __construct(){
            $this->view=new ClubesView;
            $this->model=new ClubesModel;
        }

        public function mostrarClubes(){
            $clubes=$this->model->getClubes();

            return $this->view->mostrarClubes($clubes);
        }
    }