<?php

class Reservas extends Controller {
	
	public function run(){
		$vars = $this->getVars();
		/* if  ($vars['cpf'] && $vars['senha']){
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
		}  */
##########################################################################################################

        $selectColonia= Mysql::select('app','select * from apto_tb where colonia=:colonia',array(
	 				                  ':colonia'   => $vars['vcolonia']));
        $ret = array();
        if(count($selectColonia)>"0"){
           $vdtini = \DateTime::createFromFormat('d/m/Y',$vars['vdtini']);
           if (!$vdtini) {
               throw new \Exception('Falta data ini');
           }
           $vdtfim = \DateTime::createFromFormat('d/m/Y',$vars['vdtfim']);
           if (!$vdtfim) {
              throw new \Exception('Falta data fim');
           }
           $array_aptos = array();
           for ($i=0; $i<count($selectColonia); $i++) {
               $vapto=$selectColonia[$i]['apto'];
               $selectReserva = Mysql::select('app','select * from locacao_tb where
                                              local=:colonia and apto=:apto and  data_loc  BETWEEN :vdtini AND :vdtfim',array(
					':colonia' => $vars['vcolonia'],
					':apto'    => $vapto,
					':vdtini'  => $vdtini->format('Y-m-d'),
					':vdtfim'  => $vdtfim->format('Y-m-d') ));
               if (empty($selectReserva)){
                  $array_aptos[] = $vapto;
               }
           }

           $ret['data_inicio'] = $vdtini->format('d/m/Y');
           $ret['data_fim'] = $vdtfim->format('d/m/Y');
           $ret['colonia'] = $vars['vcolonia'];
           $ret['aptos'] = $array_aptos;

        }
        echo $this->getRender()->render('./Login/reservas.html', $ret);


	}

}
