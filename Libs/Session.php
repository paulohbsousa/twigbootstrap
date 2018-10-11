<?php

class Session {

	public static function login( $username ){
		$_SESSION['login'] = $username;
		return $_SESSION;
	}

	public static function hasLogin(){
		if ( !empty($_SESSION['login']) )
			return true;
		return false;
	}

	public static function logoff(){
		unset($_SESSION['login']);
	}
	
	public static function start(){
		session_start();
	}

	public static function close(){
		session_destroy();
	}
}
