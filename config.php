<?php 


spl_autoload_register(function($class_name){


	if(file_exists("class".DIRECTORY_SEPARATOR.$class_name.".php")){
		require_once("class".DIRECTORY_SEPARATOR.$class_name.".php");
	}



});






 ?>