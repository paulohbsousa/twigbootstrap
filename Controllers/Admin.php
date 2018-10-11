<?php

class Admin extends Controller {
	
	public function run(){
		$vars = $this->getVars();
<<<<<<< HEAD
		if  ($vars['cpf'] && $vars['senha']){
			if (!Session::hasLogin() ){
				$selectLogin = Mysql::select('app','SELECT * FROM cadastros_tb WHERE cpf=:cpf AND senha=:senha LIMIT 1',array(
					':cpf'   => trim(str_replace(array('.','-','/'),'',$vars['cpf'])),
					':senha' => $vars['senha']
				));
				$erro = false;
				if (!empty($selectLogin)){
					Session::login($vars['cpf']);
				} else {
					$erro = 'Login ou senha invÃ¡lidos';
				}
				if (Session::hasLogin()){
					echo $this->getRender()->render('./Admin/admin.html', array('titulo' => 'Página de admin'));
				} else {
					echo $this->getRender()->render('./Login/login.html', array('titulo' => 'Página de Login','erro' => $erro));
				}
			} else {
				echo $this->getRender()->render('./Admin/admin.html', array('titulo' => 'Página de Login'));		
			}
		} else {
			echo $this->getRender()->render('./Admin/admin.html', array('titulo' => 'Página de Login'));		
		}
	}

}
=======
		if ($vars['email'] == 'teste@teste.com' && $vars['senha'] == 'teste'){
			Session::login($vars['email']);
		}

		if (Session::hasLogin()){
			echo $this->getRender()->render('./Admin/admin.html', array('titulo' => 'PÃ¡gina de admin'));
		} else {
			echo $this->getRender()->render('./Login/login.html', array('titulo' => 'PÃ¡gina de Login'));
		}
	}

}
>>>>>>> cac39e3d00a2a707f16f5dddb97f9737e65b0bec
