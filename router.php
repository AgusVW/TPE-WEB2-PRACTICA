<?php
require_once "app/controllers/clubes.controller.php";
require_once "app/controllers/socios.controller.php";
require_once "app/controllers/disciplinas.controller.php";

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action="Clubes";
if(!empty($_GET['action'])){
    $action=$_GET['action'];
}

$params=explode("/",$action);
$navUrl=$params[0];

switch ($params[0]) {
    case 'Clubes':
        $controller=new ClubesController();
        if(isset($params[1])){
            $controller->getClubCompleto($params[1],$navUrl);
        }else{
            $controller->mostrarClubes($navUrl);
        }
        break;

    case 'Socios':
        $controller=new SociosController();
        if(isset($params[1])){
            $controller->mostrarSociosByIdClub($params[1],$navUrl);
        }else{
            $controller->mostrarSocios($navUrl);
        }
        break;

    case 'Disciplinas':
        $controller=new DisciplinasController();
        if(isset($params[1])){
            $controller->mostrarDisciplinasByIdClub($params[1],$navUrl);
        }else{
            $controller->mostrarDisciplinas($navUrl);
        }
        break;

    default:
        "error";
        break;
}
