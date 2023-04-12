<?php
session_start();
//referencias con las demas clases para reutilizar los objetos
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

function show_error(){
	$error = new errorController();
	$error->index();
}

if(isset($_GET['controller'])){//si la variable get es true
	$nombre_controlador = $_GET['controller'].'Controller';//el nombre del controlador se concatena con el parametro GET

}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){//si los parametros son distintos
	$nombre_controlador = controller_default;//nos envia al controlador por default(index)
	
}else{
	show_error();
	exit();
}

if(class_exists($nombre_controlador)){	
	$controlador = new $nombre_controlador();//instanciamos la clase
	
	if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){//si el metodo existe 
		$action = $_GET['action'];//pasamos el valor a una variable
		$controlador->$action();//setiamos el valor 
	}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){//si son distintos 
		$action_default = action_default;//enviamos al controlador por default
		$controlador->$action_default();
	}else{
		show_error();
	}
}else{
	show_error();
}

require_once 'views/layout/footer.php';


