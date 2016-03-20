<?php
/* Author: E.J.P.C.R. - Date: 2015/07/30 - Update: 2015/12/06 */
require_once "DatabaseProvider.php";
class MySqlProvider extends DatabaseProvider // SIRVE PARA ACTUALIZAR LA NOMECLATURA Y CONFIGURACION DE LAS FUNCIONES PHP-MYSQL A LA VERSION ACTUAL O PREFERIDA
{
	private $connection;
	public function __construct($hostname, $username, $password, $database) // CONSTRUCTOR DE LA CLASE
	{
		$this->setHostname($hostname); // ASIGNA LA DIRECCION DEL SERVIDOR
		$this->setUsername($username); // ASIGNA EL NOMBRE DEL USUARIO
		$this->setPassword($password); // ASIGNA LA CONTRASEÑA DEL USUARIO
		$this->setDatabase($database); // ASIGNA EL NOMBRE DE LA BASE DE DATOS
	}
	public function connect() // CONECTA AL SERVIDOR
	{
		return $this->connection = new mysqli($this->getHostname(), $this->getUsername(), $this->getPassword(), $this->getDatabase()); // CONEXION
	}
	public function isConnected() // COMPRUEBA LA CONEXION
	{
		return !is_null($this->connection);
	}
	public function disconnect() // DESCONECTA AL SERVIDOR
	{
		return $this->connection->close();
	}
	public function getErrorNo() // OBTIENE EL TIPO DE ERROR
	{
		return $this->connection->connect_errno;
	}
	public function getError() // OBTIENE OTRO TIPO DE ERROR
	{
		return $this->connection->connect_error;
	}
	public function query($sentence) // EJECUTA LA SENTENCIA SQL
	{
		return $this->connection->query($sentence);
	}
	public function fetchArray($resource) // TRAE LOS VALORES DE UNA TABLA 
	{
		return $resource->fetch_array(MYSQLI_BOTH); /* VALOR: MYSQLI_NUM - MYSQLI_ASSOC - MYSQLI_BOTH */
	}
	public function fetchAssoc($resource) // TRAE LOS VALORES DE UNA TABLA
	{
		return $resource->fetch_assoc();
	}
	public function currentField($resource) // TRAE LOS VALORES DEL CAMPO ACTUAL
	{
		return $resource->current_field;
	}
	public function numRows($resource) // OBTIENE EL NUMERO DE REGISTROS
	{
		return $resource->num_rows;
	}
	public function escapeData($field) // LIMPIA LOS CARACTERES INVALIDOS DE UNA CADENA DE TEXTO
	{
		return $this->connection->escape_string($field);
	}
	public function freeMemory($resource) // LIBERA MEMORIA
	{
		return $resource->free();
	}
}
?>
