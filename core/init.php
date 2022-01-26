<?php

session_start();

	$GLOBALS['config'] = [

		'mysql' => [
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'dbcurse'
		],

		'remember' => [
			'cookie_name' => 'hash',
			'cookie_expiry' => 604800
		],

		'session' => [
			'session_name' => 'user',
			'token_name' => 'token'
		]

	];


spl_autoload_register(function($class){

	require_once 'classes/'.$class.'.php';

});


require_once 'functions/sanitize.php';
require_once 'functions/includePage.php';

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {

		$hash = Cookie::get(Config::get('remember/cookie_name'));
		$hashCheck = DB::getInstance()->get('visitantes_session',['hash','=',$hash]);

		if($hashCheck->count()){
			//$_SESSION['id'] = $hashCheck->first()->vistante_id;
			$_SESSION['id'] = $hashCheck->first()->vistante_id;
			//$user = new User($hashCheck->first()->user_id);
			//$user->login();
			
		}else{
			 $_SESSION['id'] = null;
		}

	}

?>