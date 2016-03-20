<?php
/* Author: E.J.P.C.R. - Date: 2015/07/30 - Update: 2015/12/06 */
require_once "MySqlProvider.php";
class DatabaseLayer
{
	// Remover los comentarios con respecto a la opción escogida para el uso de variables globales
	private $provider;/*, $result, $row, $rows; // Declarados para la primera y segunda opción de uso de variables*/
	public function __construct(/*$result = NULL, $row = NULL, $rows = array() // Segunda opción de uso de variables*/) // CONSTRUCTOR DE LA CLASE
	{
		$domain = "www.example-domain.com"; // NOMBRE DE DOMINIO O SERVIDOR REMOTO
		if($_SERVER['SERVER_NAME'] == $domain) // COMPRUEBA EL DOMINIO DEL SERVIDOR
		{
			$this->provider = new MySqlProvider("remote-svr", "remote-usr", "remote-pwd", "remote-db"); // INSTANCIA DE LA CLASE PROVEEDOR MYSQL - SERVIDOR REMOTO
		}
		else
		{
			$this->provider = new MySqlProvider("local-svr", "local-usr", "local-pwd", "local-db"); // INSTANCIA DE LA CLASE PROVEEDOR MYSQL - SERVIDOR LOCAL
		}
		/*$this->result = NULL; // Primera opción de uso de variables
		$this->row = NULL;
		$this->rows = array();*/
		/*$this->result = $result; // Segunda opción de uso de variables
		$this->row = $row;
		$this->rows = $rows*/
	}
	public function getProvider() // MANDA AL OBJETO INSTANCIADO DE LA CLASE PROVEEDOR MYSQL
	{
		return $this->provider;
	}
	public function create($sql) // CREA REGISTROS
	{
		try
		{
			$this->provider->connect();
			$this->provider->query($sql) or die($this->provider->getError());
			$this->provider->disconnect();
		}
		catch(Exception $e)
		{
			echo "!Error¡: ".$e->getMessage(); // MENSAJE DE ERROR
		}
	}
	public function read($sql) // LEE REGISTROS
	{
		$rows = array();
		try
		{
			$this->provider->connect(); // CONECTA
			/*$this->result*/ $result = $this->provider->query($sql) or die($this->provider->getError()); // CONSULTA
			while(/*$this->row*/ $row = $this->provider->fetchAssoc(/*$this->result*/$result)) { // RECORRE TODOS LOS REGISTROS
				//$this->rows[] = $this->row; // ALMACENA LOS REGISTROS
				$rows[] = $row;
			}
			$this->provider->freeMemory(/*$this->result*/$result); // LIBERA MEMORIA
			$this->provider->disconnect(); // DESCONECTA
			return /*$this->rows*/ $rows; // REGRESA O ENVIA LOS REGISTRO
		} 
		catch(Exception $e) 
		{
			echo "!Error¡: ".$e->getMessage(); // MESAJE DE ERROR
		}
	}
	public function update($sql) // ACTUALIZA REGISTROS
	{
		$this->create($sql);
	}
	public function delete($sql) // ELIMINA REGISTROS
	{
		$this->create($sql);
	}
}
?>
