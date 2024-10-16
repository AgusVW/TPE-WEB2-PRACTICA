<?php
    require_once "app/models/auth.model.php";
    require_once "app/views/auth.view.php";

    class AuthController{
        private $view;
        private $model;

        public function __construct($user=null) {
            $this->view=new AuthView($user);
            $this->model=new AuthModel();
        }

        public function mostrarLogin(){
            return $this->view->mostrarLogin();
        }

        public function login(){
            if(!isset($_POST['email']) || empty($_POST['email'])){
                return $this->view->mostrarLogin("Falta completar el email");
            }
            if(!isset($_POST['password']) || empty($_POST['password'])){
                return $this->view->mostrarLogin("Falta completar la contraseña");
            }

            $email=$_POST['email'];
            $password=$_POST['password'];

            //traigo si hay un usuario en la db con el email
            $existeUsuarioEnDb=$this->model->getUserByEmail($email);

            //verifico que exista usuario y clave
            if($existeUsuarioEnDb && password_verify($password,$existeUsuarioEnDb->password)){
                //guardo en la sesion el ID del usuario

                session_start();
                $_SESSION['ID_USER'] = $existeUsuarioEnDb->id;
                $_SESSION['EMAIL_USER'] = $existeUsuarioEnDb->email;
                $_SESSION['LAST_ACTIVITY'] = time();

                //redirijo
                header('Location: ' . BASE_URL);
            }
            else{
                return $this->view->mostrarLogin("Los datos ingresados son incorrectos");
            }
        }

        public function logout(){
            session_start(); // Va a buscar la cookie
            session_destroy(); // Borra la cookie que se buscó
            header('Location: ' . BASE_URL);
        }
    }