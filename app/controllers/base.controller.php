<?php

abstract class BaseController {
	
	/*private $controller;
	
	private $action;
	
	public static function setController($controller) {
		$this->controller = $controller;
	}
	
	public static function setAction($action) {
		$this->action = $action;
	}	
	
	public static function getController() {
		return $this->controller;
	}
	
	public static function getAction() {
		return $this->action;
	}	*/
	
	/**
	 * @all controllers must contain an index method
	 */
	abstract function index();
}

?>
