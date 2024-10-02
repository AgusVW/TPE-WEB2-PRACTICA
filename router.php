<?php
require_once "app/controllers/clubes.controller.php";

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action="inicio";
if(!empty($_GET['action'])){
    $action=$_GET['action'];
}

$params=explode("/",$action);

switch ($action) {
    case 'inicio':
        $controller=new ClubesController();
        $controller->mostrarClubes();
        break;
    
    default:
        "error";
        break;
}
