<?php

class Login extends Controller {
	
	public function run(){
		if (Session::hasLogin()){
			echo $this->getRender()->render('./Admin/admin.html', array('titulo' => 'P�gina de Login'));
		} else {
			echo $this->getRender()->render('./Login/login.html', array('titulo' => 'P�gina de Login'));
		}
	}

}
