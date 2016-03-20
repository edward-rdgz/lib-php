<?php
/* Author: E.J.P.C.R. - Date: 2015/10/04 */
require_once "Cookie.php";
class Login extends Cookie
{
	private static $log = false; // ESTADO DEL LOGUEADO
	public static $userData = array(); // DATOS DE USUARIO
	public static $numAttempts = 0; // NUMERO DE INTENTOS
	public static $maxAttempts = 3; // MAXIMO DE INTENTOS
	public static $username = "test"; // USUARIO
	public static $password = "test"; // CONTRASEÑA
	public function authentication() // AUTENTICA COOKIE + SESSION
	{
		self::$log = false;
		if(!self::checkCookie())
		{
			self::checkSession();
		}
		return self::$log;
	}
	private function checkCookie() // REVISA LA COOKIE
	{
		if(!empty($_COOKIE['auth_user']) and !empty($_COOKIE['auth_pass']))
		{
			return self::checkLogin($_COOKIE['auth_user'], $_COOKIE['auth_pass']);
		}
		else
		{
			return false;
		}
	}
	private function checkSession() // REVISA LA SESSION
	{
		if(!empty($_SESSION['auth_user']) and !empty($_SESSION['auth_pass']))
		{
			return self::checkLogin($_SESSION['auth_user'], $_SESSION['auth_pass']);
		}
		else
		{
			return false;
		}
	}
	public function checkLogin($usr = '', $pwd = '') // REVISA EL INICIO DE SESION
	{
		if($usr == self::$username && $pwd == self::$password) // INICIALMENTE SE VALIDA CONTRA DATOS PREESTABLECIDOS
		{
			self::$log = true;
			self::$userData['user'] = self::$username;
			$_SESSION['auth_user'] = self::$username;
			$_SESSION['auth_pass'] = self::$password;
			parent::setCookie("auth_user", self::$username);
			parent::setCookie("auth_pass", self::$password);
			self::$numAttempts = 0;
			return true;
		}
		else
		{
			self::$log = false;
			self::$userData = array();
			self::$numAttempts++;
			return false;
		}
		/*
		if(Login::$numAttempts >= Login::$maxAttempts)
		{
			// Mostrar al usuario una pantalla de validacion adicional con captcha en donde se realice el inicio de sesion
			exit();
		}
		*/
	}
	public function checkLogout() // REVISA EL CIERRA LA SESION
	{
		self::$log = false;
		self::$userData = array();
		unset($_SESSION['auth_user']);
		unset($_SESSION['auth_pass']);
		parent::deleteCookie("auth_user");
		parent::deleteCookie("auth_pass");
	}
}
?>