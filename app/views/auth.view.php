<?php
    class AuthView{
        private $user=null;

        public function __construct($user)
        {
            $this->user=$user;
        }
        
        public function mostrarLogin($error = '',$navUrl="Login"){
            require_once "templates/formLogin.phtml";
        }

        public function mostrarRegistroDeCuenta($error=''){

        }
    }