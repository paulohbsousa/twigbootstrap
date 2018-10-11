<?php

class Session {

<<<<<<< HEAD
	public static function login( $username ){
=======
	public static function login( string $username ){
>>>>>>> cac39e3d00a2a707f16f5dddb97f9737e65b0bec
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
<<<<<<< HEAD
}
=======
}
>>>>>>> cac39e3d00a2a707f16f5dddb97f9737e65b0bec
