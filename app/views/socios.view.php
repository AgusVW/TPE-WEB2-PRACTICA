<?php
    class SociosView{
        public function mostrarSocios($socios,$navUrl){
            require "templates/socios.phtml";
        }

        public function mostrarSociosByIdClub($sociosByClub,$navUrl,$id){
            require_once "templates/sociosPorClub.phtml";
        }
    }