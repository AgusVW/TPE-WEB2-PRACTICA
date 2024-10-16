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

        public function __construct($res){
            $this->view=new ClubesView($res);
            $this->modelClub=new ClubesModel();
            $this->modelSocio=new SociosModel();
            $this->modelDisciplina=new DisciplinaModel();
        }

        public function mostrarClubes(){
            $clubes=$this->modelClub->getClubes();

            return $this->view->mostrarClubes($clubes);
        }

        public function obtenerClubById($idClub){
            $clubSocio=$this->modelClub->getClubById($idClub);

            return $clubSocio;
        }

        public function obtenerClubCompleto($id){
            $club=$this->modelClub->getClubById($id);
            $socios=$this->modelSocio->getSociosByClub($id);
            $disciplinas=$this->modelDisciplina->getDisciplinasByClub($id);

            if(!$club){
                return $this->view->mostrarError("El club particular a mostrar no existe");
            }

            return $this->view->mostrarClubCompleto($club,$socios,$disciplinas);
        }

        public function mostrarInsert(){
            $clubes=$this->modelClub->getClubes();

            return $this->view->mostrarInsert($clubes);
        }

        public function insertarClub(){
            if (!isset($_POST['club']) || empty($_POST['club'])) {
                return $this->view->mostrarError('Falta completar el club');
            }

            if (!isset($_POST['fundacion']) || empty($_POST['fundacion'])) {
                return $this->view->mostrarError('Falta completar la fundacion del club');
            }

            $club=$_POST['club'];
            $fundacion=$_POST['fundacion'];
            $sede=$_POST['sede'];
            $localidad=$_POST['localidad'];
            $contacto=$_POST['contacto'];

            $enviar=$this->modelClub->addClub($club,$localidad,$fundacion,$sede,$contacto);

            header('Location: ' . BASE_URL);
        }

        public function eliminarClub($id){
            $club=$this->modelClub->getClubById($id);

            if(!$club){
                $this->view->mostrarError("El club que quiere borrar no existe");
            }

            $this->modelClub->deleteClub($id);

            header('Location: ' . BASE_URL);
        }

        public function editarClub($id){
            if ($_SERVER['REQUEST_METHOD']=='GET'){
                $club = $this->modelClub->getClubById($id);
                if(!$club){
                    return $this->view->mostrarError("El club " . $id . " a editar no existe");
                }
                return $this->view->mostrarEditarClub($club);
            }

            if (!isset($_POST['club']) || empty($_POST['club'])) {
                return $this->view->mostrarError('Falta completar el club');
            }

            if (!isset($_POST['fundacion']) || empty($_POST['fundacion'])) {
                return $this->view->mostrarError('Falta completar la fundacion del club');
            }

            $club=$_POST['club'];
            $fundacion=$_POST['fundacion'];
            $sede=$_POST['sede'];
            $localidad=$_POST['localidad'];
            $contacto=$_POST['contacto'];

            $editar=$this->modelClub->updateClub($id,$club,$fundacion,$localidad,$sede,$contacto);

            header('Location: ' . BASE_URL);
            
        }

        
    }