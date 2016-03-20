<?php
/* Author: E.J.P.C.R. - Date: 2015/09/14 */
class Password
{
	public function __construct() //  CONSTRUCTOR
	{
		$this->checkBlowfish();
	}
	private function checkBlowfish() // VERIFICA LA EXISTENCIA DE BLOWFISH
	{
		if(!defined("CRYPT_BLOWFISH") && !CRYPT_BLOWFISH) // BLOWFISH ES DE PHP
		{
			echo "Algoritmo Blowfish no reportado";
			die();
		}
	}
	public function getPassword($password = null) // OBTIENE LA CONTRASEÑA
	{
		$option = array("cost" => 7);
		return password_hash($password, PASSWORD_BCRYPT, $option); // PASSWORD_HASH ES DE PHP
	}
	public function passwordVerify($pass1, $pass2) // VERIFICA LA CONTRASEÑA
	{
		if(password_verify($pass1, $pass2)) // PASSWORD_VERIFY ES DE PHP
		{
			return true;
		}
		return false;
	}
}
?>