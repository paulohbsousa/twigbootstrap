<?php
require('vendor/autoload.php');
/*Libs*/
require('Libs/Session.php');
require('Libs/Mysql.php');

/*Logica do codigo*/
require('Controllers/Controller.php');
require('Controllers/Admin.php');
require('Controllers/Login.php');
require('Controllers/Cadastro.php');
require('Controllers/Reservas.php');

putenv('APP_DBHOST=localhost');
putenv('APP_DBNAME=casa_colonia');
putenv('APP_DBUSERNAME=root');
putenv('APP_DBPASSWORD=a27#2004pp');

try{
	Session::start();

	$loader = new Twig_Loader_Filesystem(__DIR__.'/Views/');
	Controller::setRender( new Twig_Environment($loader) );

	$tipo = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : '';

#print("$tipo|$acao|$vcolonia|$vdtfim");
#if($tipo<>""){
# exit;
#}
	switch ($tipo){
		case 'admin':
			$handler = new Admin($_REQUEST);
		break;
		case 'meusdados':
             $handler = new Admin($_REQUEST);
		break;
		case 'minhasreservas':
			$handler = new Admin($_REQUEST);
		break;
		case 'reservas':
			$handler = new Reservas($_REQUEST);
		break;
		case 'cadastro':
			$handler = new Cadastro($_REQUEST);
		break;
		default:
		case 'login':
			$handler = new Login($_REQUEST);
		break;
	}

	$handler->run();
} catch (\Exception $e){
	echo "Ocorreu um erro!";
	error_log($e->getMessage(),3,sys_get_temp_dir()."/error.log");
}
