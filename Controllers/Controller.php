<?php

abstract class Controller {
	
	private static $render;

	private $vars;

	public function __construct(Array $vars){
		$this->vars = $vars;
		return $this;
	}

	protected function getVars(){
		return $this->vars;
	}

	abstract public function run();

	public static function setRender( $render ){
		Controller::$render = $render;
	}

	protected function getRender(){
		return Controller::$render;
	}

}