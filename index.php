<?php

$site_path = realpath(dirname(__FILE__));
define ('__SITE_PATH', $site_path);
define ('__SITE_URL', 'http://localhost/projects/mvc/');

require_once __SITE_PATH . "/config/main.php";

try {

	if(isset($_GET['controller'])){
		$controller = $_GET['controller'];
		$action     = isset($_GET['action']) ? $_GET['action'] : "index";
	}
	else if(empty($_GET)){
		$controller = 'home';
		$action     = 'index';
	}
	else throw new Exception('Wrong page!');
	
	require_once __SITE_PATH . "/config/routes.php";
}
catch(Exception $e) {
	// Display the error page using the "render()" helper function:
	render('error',array('message'=>$e->getMessage()));
}

?>