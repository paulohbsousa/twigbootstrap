<?php

class Login extends Controller {
	
	public function run(){
		echo $this->getRender()->render('./Login/login.html', array('titulo' => 'Página de Login'));
	}

}