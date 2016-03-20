<?php
/* Author: E.J.P.C.R. - Date: 2015/07/30 */
abstract class DatabaseProvider
{
	private $hostname, $username, $password, $database;
	protected function setHostname($hostname) // ASIGNA EL SERVIDOR
	{
		$this->hostname = $hostname;
	}
	protected function getHostname() // CONSIGUE EL SERVIDOR
	{
		return $this->hostname;
	}
	protected function setUsername($username) // ASIGNA EL USUARIO
	{
		$this->username = $username;
	}
	protected function getUsername() // CONSIGUE EL USUARIO
	{
		return $this->username;
	}
	protected function setPassword($password) // ASIGNA LA CONTRASEÑA
	{
		$this->password = $password;
	}
	protected function getPassword() // CONSIGUE LA CONTRASEÑA
	{
		return $this->password;
	}
	protected function setDatabase($database) // ASIGNA LA BASE DE DATOS
	{
		$this->database = $database;
	}
	protected function getDatabase() // CONSIGUE LA BASE DE DATOS
	{
		return $this->database;
	}
	public abstract function connect(); // CONECTA CON LA BASE DE DATOS
	public abstract function isConnected(); // COMPRUEBA LA CONEXION
	public abstract function disconnect(); // DESCONECTA CON LA BASE DE DATOS
	public abstract function getErrorNo(); // CONSIGUE EL TIPO DE ERROR-NO
	public abstract function getError(); // OBTIENE EL TIPO DE ERROR
	public abstract function query($sentence); // EJECUTA LA SENTENCIA
	public abstract function fetchArray($resource); // TRAE EL RECURSO TOTAL EN FORMATO DE TEXTO O NUMERO
	public abstract function fetchAssoc($resource); // TRAE EL RECURSO TOTAL EN FORMATO DE TEXTO
	public abstract function currentField($resource); // DEVUELVE LOS DATOS DE UN CAMPO ACTUAL
	public abstract function numRows($resource); // TRAE EL NUMERO DE FILAS
	public abstract function escapeData($field); // REMUEVE CARACTERES INVALIDOS DE LA CADENA
	public abstract function freeMemory($resource); // LIBERA MEMORIA EN EL SERVIDOR
}
?>
