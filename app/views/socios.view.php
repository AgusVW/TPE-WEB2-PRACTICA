<?php
    class SociosView{
        private $user=null;

        public function __construct($user) {
            $this->user=$user;
        }

        public function mostrarSocios($socios,$navUrl="Socios"){
            require "templates/socios.phtml";
        }

        public function mostrarSociosPorClub($sociosByClub,$id,$navUrl="Socios"){
            require_once "templates/sociosPorClub.phtml";
        }

        public function mostrarEditarSocio($socio,$navUrl="Editar"){
            require_once "templates/formUpdate/formSocio.phtml";
        }

        public function mostrarError($error='',$navUrl="Error"){
            require_once "templates/error.phtml";
        }
    }