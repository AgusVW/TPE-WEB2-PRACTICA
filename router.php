<?php
require_once 'libs/user.php';
require_once 'app/authusuario/autencticarUsuario.php';
require_once "app/controllers/clubes.controller.php";
require_once "app/controllers/socios.controller.php";
require_once "app/controllers/disciplinas.controller.php";
require_once "app/controllers/auth.controller.php";

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res=new User();

$action="Clubes";
if(!empty($_GET['action'])){
    $action=$_GET['action'];
}

$params=explode("/",trim($action,'/'));
$navUrl=$params[0];

switch ($params[0]) {
    case 'Clubes':
        sessionIndiferentViewPage($res);
        $controller=new ClubesController($res->user);
        if(isset($params[1]))
            $controller->obtenerClubCompleto($params[1]);
        else
            $controller->mostrarClubes();
        break;

    case 'Socios':
        sessionIndiferentViewPage($res);
        $controller=new SociosController($res->user);
        if(isset($params[1])){
            $controller->mostrarSociosPorClub($params[1]);
        }else{
            $controller->mostrarSocios();
        }
        break;

    case 'Disciplinas':
        sessionIndiferentViewPage($res);
        $controller=new DisciplinasController($res->user);
        if(isset($params[1])){
            $controller->mostrarDisciplinasPorClub($params[1]);
        }else{
            $controller->mostrarDisciplinas();
        }
        break;

    case 'Insertar':
        sessionAuthMiddleware($res);
        $controller=new ClubesController($res->user);
        $controller->mostrarInsert();
        break;

    case 'insertarClub':
        sessionAuthMiddleware($res);
        $controller=new ClubesController($res->user);
        $controller->insertarClub();
        break;
    case 'eliminarClub':
        sessionAuthMiddleware($res);
        $controller=new ClubesController($res->user);
        $controller->eliminarClub($params[1]);
        break;

    case 'insertarSocio':
        sessionAuthMiddleware($res);
        $controller=new SociosController($res->user);
        $controller->insertarSocio();
        break;
    case 'eliminarSocio':
        sessionAuthMiddleware($res);
        $controller=new SociosController($res->user);
        $controller->eliminarSocio($params[1]);
        break;

    case 'insertarDisciplina':
        sessionAuthMiddleware($res);
        $controller=new DisciplinasController($res->user);
        $controller->insertarDisciplina();
        break;
    case 'eliminarDisciplina':
        sessionAuthMiddleware($res);
        $controller=new DisciplinasController($res->user);
        $controller->eliminarDisciplina($params[1]);
        break;

    case 'Editar':
        sessionAuthMiddleware($res);
        if(!isset($params[1]))
            header('Location: ' . BASE_URL);
        switch($params[1]){
            case 'Club':
                if(isset($params[2])){
                    $controller=new ClubesController($res->user);
                    $controller->editarClub($params[2]);
                }else{
                    header('Location: ' . BASE_URL);
                }
                break;
                
            case 'Socio':
                if(isset($params[2])){
                    $controller=new SociosController($res->user);
                    $controller->editarSocio($params[2]);
                }else{
                    header('Location: ' . BASE_URL . 'Socios');
                }
                break;

            case 'Disciplina':
                if(isset($params[2])){
                    $controller=new DisciplinasController($res->user);
                    $controller->editarDisciplina($params[2]);
                }else{
                    header('Location: ' . BASE_URL . 'Disciplinas');
                }
                break;
        }
        break;

    case 'mostrarLogin':
        $controller=new AuthController($res->user);
        $controller->mostrarLogin();
        break;

    case 'Login':
        $controller=new AuthController();
        $controller->login();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();

    default:
        "Error 404 Page Not Found";
        break;
}
