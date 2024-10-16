<?php
    class ClubesView{
        private $user=null;

        public function __construct($user) {
            $this->user=$user;
        }

        public function mostrarClubes($clubes,$navUrl="Clubes"){
            require "templates/clubes.phtml";
        }

        public function mostrarClubCompleto($club,$socios,$disciplinas,$navUrl="Club"){
            require  "templates/clubCompleto.phtml";
        }

        public function mostrarInsert($clubes,$navUrl="Insertar"){
            require_once "templates/insertar.phtml";
        }

        public function mostrarEditarClub($club,$navUrl="Editar"){
            require_once "templates/formUpdate/formClub.phtml";
        }

        public function mostrarError($error='',$navUrl="Error"){
            require_once "templates/error.phtml";
        }

    }

    