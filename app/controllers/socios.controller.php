<?php
    require_once "app/models/socios.model.php";
    require_once "app/views/socios.view.php";

    class SociosController{
        private $model;
        private $view;

        public function __construct($res) {
            $this->model=new SociosModel();
            $this->view=new SociosView($res);
        }

        public function mostrarSocios(){
            $socios=$this->model->getSocios();

            return $this->view->mostrarSocios($socios);
        }

        public function mostrarSociosPorClub($id){
            $sociosByClub=$this->model->getSociosByClub($id);

            return $this->view->mostrarSociosPorClub($sociosByClub,$id);
        }

        public function insertarSocio(){
            if (!isset($_POST['dni']) || empty($_POST['dni'])) {
                return $this->view->mostrarError('Falta completar el DNI');
            }

            if (!isset($_POST['id_club']) || empty($_POST['id_club'])) {
                return $this->view->mostrarError('Falta completar el club asociado');
            }

            $nombre=$_POST['nombre'];
            $apellido=$_POST['apellido'];
            $dni=$_POST['dni'];
            $id_club=$_POST['id_club'];

            $enviar=$this->model->addSocio($nombre,$apellido,$dni,$id_club);

            header('Location: ' . BASE_URL . 'Socios');
        }

        public function eliminarSocio($id){
            $socio=$this->model->getSocioById($id);

            if(!$socio){
                $this->view->mostrarError("El socio a eliminar no existe");
            }

            $this->model->deleteSocio($id);

            header('Location: '. BASE_URL . 'Socios');
        }

        public function editarSocio($id){
            if ($_SERVER['REQUEST_METHOD']=='GET'){
                $socio = $this->model->getSocioById($id);
                if(!$socio){
                    return $this->view->mostrarError("El socio " . $id . " a editar no existe");
                }

                return $this->view->mostrarEditarSocio($socio);
            }

            if (!isset($_POST['dni']) || empty($_POST['dni'])) {
                return $this->view->mostrarError('Falta completar el DNI');
            }

            if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
                return $this->view->mostrarError('Falta completar el nombre del socio');
            }

            $nombre=$_POST['nombre'];
            $apellido=$_POST['apellido'];
            $dni=$_POST['dni'];
        
            $editar=$this->model->updateSocio($id,$nombre,$apellido,$dni);

            header('Location: ' . BASE_URL . 'Socios');
            
        }
    }
