<?php

class Login extends Controller {
	
	public function run(){
<<<<<<< HEAD
		if (Session::hasLogin()){
			echo $this->getRender()->render('./Admin/admin.html', array('titulo' => 'P�gina de Login'));
		} else {
			echo $this->getRender()->render('./Login/login.html', array('titulo' => 'P�gina de Login'));
		}
	}

}
=======
		echo $this->getRender()->render('./Login/login.html', array('titulo' => 'Página de Login'));
	}

}
>>>>>>> cac39e3d00a2a707f16f5dddb97f9737e65b0bec
