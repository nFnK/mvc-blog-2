<?php

function route($controller, $action = "index"){
	
	if(file_exists(__SITE_PATH . "/app/controllers/" . $controller . ".controller.php")) {
		require_once __SITE_PATH . "/app/controllers/" . $controller . ".controller.php";
		$controllerName = ucwords($controller) . "Controller";
		$con = new $controllerName();
			
		if(file_exists(__SITE_PATH . "/app/models/" . $controller . ".model.php")) {
			require_once __SITE_PATH . "/app/models/" . $controller . ".model.php";
		}
		
		$con->{ $action }();
	}
		
}

route($controller, $action);

?>