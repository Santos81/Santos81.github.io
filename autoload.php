<?php

function controllers_autoload($classname){
	include 'controllers/' . $classname . '.php';//contatenamos el nombre de la clase 
}

spl_autoload_register('controllers_autoload');