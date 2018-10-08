<?php

require('vendor/autoload.php');
require('Libs/Session.php');
require('Controllers/Controller.php');
require('Controllers/Admin.php');
require('Controllers/Login.php');


Session::start();

$loader = new Twig_Loader_Filesystem(__DIR__.'/Views/');
Controller::setRender( new Twig_Environment($loader) );

$tipo = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : '';

switch ($tipo){
	case 'admin':
		$handler = new Admin($_REQUEST);
	break;
	default:
	case 'login':
		$handler = new Login($_REQUEST);
	break;
}

$handler->run();

