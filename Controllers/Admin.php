<?php

class Admin extends Controller {
	
	public function run(){
		$vars = $this->getVars();
		if ($vars['email'] == 'teste@teste.com' && $vars['senha'] == 'teste'){
			Session::login($vars['email']);
		}

		if (Session::hasLogin()){
			echo $this->getRender()->render('./Admin/admin.html', array('titulo' => 'Página de admin'));
		} else {
			echo $this->getRender()->render('./Login/login.html', array('titulo' => 'Página de Login'));
		}
	}

}