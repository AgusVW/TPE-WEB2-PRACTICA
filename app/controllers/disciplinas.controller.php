<?php
    require_once "app/models/disciplinas.model.php";
    require_once "app/views/disciplinas.view.php";

    class DisciplinasController{
        private $model;
        private $view;

        public function __construct($res){
            $this->model=new DisciplinaModel();
            $this->view=new DisciplinasView($res);
        }

        public function mostrarDisciplinas(){
            $disciplinas=$this->model->getDisciplinas();

            return $this->view->mostrarDisciplinas($disciplinas);
        }

        public function mostrarDisciplinasPorClub($id){
            $disciplinasByClub=$this->model->getDisciplinasByClub($id);

            return $this->view->mostrarDisciplinasPorClub($disciplinasByClub,$id);
        }

        public function insertarDisciplina(){
            if (!isset($_POST['deporte']) || empty($_POST['deporte'])) {
                return $this->view->mostrarError('Falta completar el deporte correspondiente');
            }

            if (!isset($_POST['id_club']) || empty($_POST['id_club'])) {
                return $this->view->mostrarError('Falta completar el club asociado');
            }

            $deporte=$_POST['deporte'];
            $direccion=$_POST['direccion'];
            $contacto=$_POST['contacto'];
            $id_club=$_POST['id_club'];

            $enviar=$this->model->addDisciplina($deporte,$direccion,$contacto,$id_club);

            header('Location: ' . BASE_URL . 'Disciplinas');
        }

        public function eliminarDisciplina($id){
            $disciplina=$this->model->getDisciplinaById($id);

            if(!$disciplina){
                $this->view->mostrarError("La disciplina a eliminar no existe");
            }

            $this->model->deleteDisciplina($id);

            header('Location: '. BASE_URL . 'Disciplinas');
        }

        public function editarDisciplina($id){
            if ($_SERVER['REQUEST_METHOD']=='GET'){
                $disciplina = $this->model->getDisciplinaById($id);
                if(!$disciplina){
                    return $this->view->mostrarError("La disciplina " . $id . " a editar no existe");
                }
                
                return $this->view->mostrarEditarDisciplina($disciplina);
            }

            if (!isset($_POST['deporte']) || empty($_POST['deporte'])) {
                return $this->view->mostrarError('Falta completar el deporte');
            }

            if (!isset($_POST['contacto']) || empty($_POST['contacto'])) {
                return $this->view->mostrarError('Falta completar el contacto');
            }

            $deporte=$_POST['deporte'];
            $direccion=$_POST['direccion'];
            $contacto=$_POST['contacto'];
        
            $editar=$this->model->updateDisciplina($id,$deporte,$direccion,$contacto);

            header('Location: ' . BASE_URL . 'Disciplinas');
            
        }


    }