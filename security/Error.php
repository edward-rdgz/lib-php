<?php
/* Author: E.J.P.C.R. - Date: 2015/09/14 */
class Error
{
	public $errorType = array( // TIPOS DE ERRORES
		1 => "ERROR",
		2 => "WARNING",
		4 => "PARSE ERROR",
		8 => "NOTICE",
		16 => "CORE ERROR",
		32 => "CORE WARNING",
		64 => "COMPILE ERROR",
		128 => "COMPILE WARNING",
		256 => "USER ERROR",
		512 => "USER WARNING",
		1024 => "USER NOTICE"
	);
	private $showErrors = true; // MUESTRA ERRORES
	private $logErrors = true; // REGISTRA ERRORES
	private $fileErrors = '/tmp/php_errores.log'; // ARCHIVO DE ERRORES
	public function __construct() // CONSTRUCTOR
	{
		$manager = set_error_handler(array($this,'managerErrors'));
		error_reporting(E_ALL);
	}
	public function managerErrors($errorNo, $errorStr, $file, $line, $context) // ADMINISTRA ERRORES
	{
		$strError = "<pre>";
		$strError .= "-- ERROR ".$this->errorType[$errorNo]." --".PHP_EOL;
		$strError .= "FECHA: ".date("Y-m-d H:i:s").PHP_EOL;
		$strError .= "ARCHIVO: ".$file.PHP_EOL;
		$strError .= "LINEA: ".$line.PHP_EOL;
		$strError .= "IP SERVIDOR: ".$_SERVER['SERVER_ADDR'].PHP_EOL;
		$strError .= "IP USUARIO: ".$_SERVER['REMOTE_ADDR'].PHP_EOL;
		$strError .= "MENSAJE: ".$errorStr.PHP_EOL;
		$strError .= "-- ERROR ".$this->errorType[$errorNo]." --".PHP_EOL;
		$strError .= "</pre>";
		if($this->logErrors)
		{
			if(is_writable($this->fileErrors))
			{
				$logText = file_get_contents($this->fileErrors);
				$logText .= $strError.PHP_EOL;
				file_get_contents($this->fileErrors, $logText);
			}
		}
		if($this->showErrors)
		{
			echo $strError;
		}
		else
		{
			echo "ERROR".PHP_EOL;
		}
	}
}
?>