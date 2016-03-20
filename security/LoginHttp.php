<?php
/* Author: E.J.P.C.R. - Date: 2015/10/04 */
class LoginHttp
{
	private static $log = false;
	public static $userData = array();
	private static $username = 'test';
	private static $password = 'test';
	private static $message = array('ingreso' => 'Proporcione sus datos.', 'error' => 'Usted no tiene permisos para acceder.');
	public function protect() // PROTEGE EL ACCESO, SE PREDEFINE AL COMIENZO DE LA CABECERA DE LA PAGINA
	{
		if(empty($_SERVER['PHP_AUTH_USER'])) // VERIFICA EL VALOR DEL USUARIO
		{
			header('WWW-Authenticate: Basic realm="'.self::$message['ingreso'].'"'); // CABECERA DEL MENSAJE
			header('HTTP/1.0 401 Unauthorized'); // CABECERA DE ERROR
			echo self::$message['error'];
			exit();
		}
		else 
		{
			if(self::checkLogin())
			{
				header('location: http://www.google.com'); // REDIRIGE AL USUARIO AL CONTENIDO QUE NO TIENE PERMITIDO
			}
			else
			{
				self::protect();
			}
		}
		/*
		// PREDEFINIR LO SIGUIENTE EN LA CABECERA DEL SITIO
		$log = new LoginHttp();
		$log->protect();
		$_SERVER['PHP_AUTH_USER'];
		$_SERVER['PHP_AUTH_PW'];
		*/
	}
	public function checkLogin() // REVISA EL INICIO DE SESION
	{
		$usr = $_SERVER['PHP_AUTH_USER'];
		$pass = $_SERVER['PHP_AUTH_PW'];
		if($usr == self::$username && $pass == self::$password)
		{
			self::$log = true;
			self::$userData['username'] = self::$username; // GUARDA EL DATO DE LA BD
			self::$userData['password'] = md5(self::$password);
			return true;
		}
		else
		{
			self::$log = false;
			self::$userData = array();
			$_SERVER['PHP_AUTH_USER'] = '';
			$_SERVER['PHP_AUTH_PW'] = '';
			return false;
		}
	}
	public function checkLogout() // REVISA EL CIERRE DE SESION
	{
		self::$log = false;
		self::$userData = array();
		$_SERVER['PHP_AUTH_USER'] = '';
		$_SERVER['PHP_AUTH_PW'] = '';
	}
}
?>