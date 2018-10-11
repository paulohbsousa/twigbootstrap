<?php

class Cadastro extends Controller {
	
	public function run(){
		$variaveis = $this->getVars();
		switch ($variaveis['acao']){
			case 'cadastrar':
				//insere no banco
				echo $this->getRender()->render('./Login/login.html', array('titulo' => 'Pag de login','nome' => $variaveis['nome'] ,'sucesso' => true ));				
			break;
			default:
				echo $this->getRender()->render('./Login/cadastro.html', array('titulo' => 'Pag de cadastro'));
			break;
		}
	}

}
