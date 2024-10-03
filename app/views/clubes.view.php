<?php
    class ClubesView{

        public function mostrarClubes($clubes,$navUrl){
            require "templates/clubes.phtml";
        }

        public function mostrarClubCompleto($club,$socios,$disciplinas,$navUrl){
            require  "templates/clubCompleto.phtml";
        }

    }

    