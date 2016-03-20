<?php
/* Author: E.J.P.C.R. - Date: 2015/09/14 */
class Filter
{
	private $options;
	public function __construct()
	{
		$this->options = NULL;
	}
	/* SANEAR TIPOS DE DATOS */
	public function cleanEmail($var) // SANEA CORREO ELECTRONICO
	{
		return filter_var($var, FILTER_SANITIZE_EMAIL);
	}
	public function cleanSpecialCharacter($var) // SANEA CARACTERES ESPECIALES
	{
		$this->options = array(FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH, FILTER_FLAG_ENCODE_HIGH);
		return filter_var($var, FILTER_SANITIZE_SPECIAL_CHARS, $this->options);
	}
	public function cleanString($var) // SANEA CADENAS DE TEXTO
	{
		$this->options = array(FILTER_FLAG_NO_ENCODE_QUOTES, FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH, FILTER_FLAG_ENCODE_LOW, FILTER_FLAG_ENCODE_HIGH, FILTER_FLAG_ENCODE_AMP);
		return filter_var($var, FILTER_SANITIZE_STRING, $this->options);
	}
	public function cleanInteger($var) // SANEA NUMEROS ENTEROS
	{
		return filter_var($var, FILTER_SANITIZE_NUMBER_INT);
	}
	public function cleanFloat($var) // SANEA NUMEROS FLOTANTES
	{
		$this->options = array(FILTER_FLAG_ALLOW_FRACTION, FILTER_FLAG_ALLOW_THOUSAND, FILTER_FLAG_ALLOW_SCIENTIFIC);
		return filter_var($var, FILTER_SANITIZE_NUMBER_FLOAT, $this->options);
	}
	public function cleanUrl($var) // SANEA URL
	{
		return filter_var($var, FILTER_SANITIZE_URL);
	}
	/* VALIDAR TIPOS DE DATOS */
	public function validateBoolean($var) // VALIDA VALORES BOOLEANOS
	{
		$this->options = array(FILTER_NULL_ON_FAILURE);
		return filter_var($var, FILTER_VALIDATE_BOOLEAN, $this->options);
	}
	public function validateEmail($var) // VALIDA CORREO ELECTRONICO
	{
		return filter_var($var, FILTER_VALIDATE_EMAIL);
	}
	public function validateInteger($var) // VALIDA NUMEROS ENTEROS
	{
		return filter_var($var, FILTER_VALIDATE_INT);
	}
	public function validateFloat($var) // VALIDA NUMEROS FLOTANTES
	{
		$this->options = array(FILTER_FLAG_ALLOW_THOUSAND);
		return filter_var($var, FILTER_VALIDATE_FLOAT, $this->options);
	}
	public function validateIp($var) // VALIDA DIRECCIONES IP
	{
		$this->options = array(FILTER_FLAG_IPV4);
		return filter_var($var, FILTER_VALIDATE_IP, $this->options);
	}
	public function validateUrl($var) // VALIDA URL
	{
		$this->options = array(FILTER_FLAG_PATH_REQUIRED, FILTER_FLAG_QUERY_REQUIRED);
		return filter_var($var, FILTER_VALIDATE_URL, $this->options);
	}
	public function validateDate($var) // VALIDA FORMATO DE FECHA
	{
		$this->options = array('options'=>array('regexp'=>'~^\d{2}/\d{2}/\d{4}$~')); // /\d{2}\/\d{2}\/\d{4}/
		return filter_var($var, FILTER_VALIDATE_REGEXP, $this->options);
	}
	public function validatePhoneNumber($var) // VALIDA FORMATO TELEFONICO
	{
		$this->options = array('options'=>array('regexp'=>'/^[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}$/')); // OPCION SIMPLE -> /[^0-9]/ 
		return filter_var($var, FILTER_VALIDATE_REGEXP, $this->options);
	}
	/* SANEAR VARIABLES EXTERNAS TIPO GET */
	public function cleanInputGetEmail($var) // SANEA CORREO ELECTRONICO
	{
		return filter_input(INPUT_GET, $var, FILTER_SANITIZE_EMAIL);
	}
	public function cleanInputGetSpecialCharacter($var) // SANEA CARACTERES ESPECIALES
	{
		$this->options = array(FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH, FILTER_FLAG_ENCODE_HIGH);
		return filter_input(INPUT_GET, $var, FILTER_SANITIZE_SPECIAL_CHARS, $this->options);
	}
	public function cleanInputGetString($var) // SANEA CADENAS DE TEXTO
	{
		$this->options = array(FILTER_FLAG_NO_ENCODE_QUOTES, FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH, FILTER_FLAG_ENCODE_LOW, FILTER_FLAG_ENCODE_HIGH, FILTER_FLAG_ENCODE_AMP);
		return filter_input(INPUT_GET, $var, FILTER_SANITIZE_STRING, $this->options);
	}
	public function cleanInputGetInteger($var) // SANEA NUMEROS ENTEROS
	{
		return filter_input(INPUT_GET, $var, FILTER_SANITIZE_NUMBER_INT);
	}
	public function cleanInputGetFloat($var) // SANEA NUMEROS FLOTANTES
	{
		$this->options = array(FILTER_FLAG_ALLOW_FRACTION, FILTER_FLAG_ALLOW_THOUSAND, FILTER_FLAG_ALLOW_SCIENTIFIC);
		return filter_input(INPUT_GET, $var, FILTER_SANITIZE_NUMBER_FLOAT, $this->options);
	}
	public function cleanInputGetUrl($var) // SANEA URL
	{
		return filter_input(INPUT_GET, $var, FILTER_SANITIZE_URL);
	}
	/* VALIDAR VARIABLES EXTERNAS TIPO GET */
	public function validateInputGetBoolean($var) // VALIDA VALORES BOOLEANOS
	{
		$this->options = array(FILTER_NULL_ON_FAILURE);
		return filter_input(INPUT_GET, $var, FILTER_VALIDATE_BOOLEAN, $this->options);
	}
	public function validateInputGetEmail($var) // VALIDA CORREO ELECTRONICO
	{
		return filter_input(INPUT_GET, $var, FILTER_VALIDATE_EMAIL);
	}
	public function validateInputGetInteger($var) // VALIDA NUMEROS ENTEROS
	{
		return filter_input(INPUT_GET, $var, FILTER_VALIDATE_INT);
	}
	public function validateInputGetFloat($var) // VALIDA NUMEROS FLOTANTES
	{
		$this->options = array(FILTER_FLAG_ALLOW_THOUSAND);
		return filter_input(INPUT_GET, $var, FILTER_VALIDATE_FLOAT, $this->options);
	}
	public function validateInputGetIp($var) // VALIDA DIRECCIONES IP
	{
		$this->options = array(FILTER_FLAG_IPV4);
		return filter_input(INPUT_GET, $var, FILTER_VALIDATE_IP, $this->options);
	}
	public function validateInputGetUrl($var) // VALIDA URL
	{
		$this->options = array(FILTER_FLAG_PATH_REQUIRED, FILTER_FLAG_QUERY_REQUIRED);
		return filter_input(INPUT_GET, $var, FILTER_VALIDATE_URL, $this->options);
	}
	public function validateInputGetDate($var) // VALIDA FORMATO DE FECHA
	{
		$this->options = array('options'=>array('regexp'=>'~^\d{2}/\d{2}/\d{4}$~')); // /\d{2}\/\d{2}\/\d{4}/
		return filter_input(INPUT_GET, $var, FILTER_VALIDATE_REGEXP, $this->options);
	}
	public function validateInputGetPhoneNumber($var) // VALIDA FORMATO TELEFONICO
	{
		$this->options = array('options'=>array('regexp'=>'/^[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}$/')); // OPCION SIMPLE -> /[^0-9]/ 
		return filter_input(INPUT_GET, $var, FILTER_VALIDATE_REGEXP, $this->options);
	}
	/* SANEAR VARIABLES EXTERNAS TIPO POST */
	public function cleanInputPostEmail($var) // SANEA CORREO ELECTRONICO
	{
		return filter_input(INPUT_POST, $var, FILTER_SANITIZE_EMAIL);
	}
	public function cleanInputPostSpecialCharacter($var) // SANEA CARACTERES ESPECIALES
	{
		$this->options = array(FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH, FILTER_FLAG_ENCODE_HIGH);
		return filter_input(INPUT_POST, $var, FILTER_SANITIZE_SPECIAL_CHARS, $this->options);
	}
	public function cleanInputPostString($var) // SANEA CADENAS DE TEXTO
	{
		$this->options = array(FILTER_FLAG_NO_ENCODE_QUOTES, FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH, FILTER_FLAG_ENCODE_LOW, FILTER_FLAG_ENCODE_HIGH, FILTER_FLAG_ENCODE_AMP);
		return filter_input(INPUT_POST, $var, FILTER_SANITIZE_STRING, $this->options);
	}
	public function cleanInputPostInteger($var) // SANEA NUMEROS ENTEROS
	{
		return filter_input(INPUT_POST, $var, FILTER_SANITIZE_NUMBER_INT);
	}
	public function cleanInputPostFloat($var) // SANEA NUMEROS FLOTANTES
	{
		$this->options = array(FILTER_FLAG_ALLOW_FRACTION, FILTER_FLAG_ALLOW_THOUSAND, FILTER_FLAG_ALLOW_SCIENTIFIC);
		return filter_input(INPUT_POST, $var, FILTER_SANITIZE_NUMBER_FLOAT, $this->options);
	}
	public function cleanInputPostUrl($var) // SANEA URL
	{
		return filter_input(INPUT_POST, $var, FILTER_SANITIZE_URL);
	}
	/* VALIDAR VARIABLES EXTERNAS TIPO POST */
	public function validateInputPostBoolean($var) // VALIDA VALORES BOOLEANOS
	{
		$this->options = array(FILTER_NULL_ON_FAILURE);
		return filter_input(INPUT_POST, $var, FILTER_VALIDATE_BOOLEAN, $this->options);
	}
	public function validateInputPostEmail($var) // VALIDA CORREO ELECTRONICO
	{
		return filter_input(INPUT_POST, $var, FILTER_VALIDATE_EMAIL);
	}
	public function validateInputPostInteger($var) // VALIDA NUMEROS ENTEROS
	{
		return filter_input(INPUT_POST, $var, FILTER_VALIDATE_INT);
	}
	public function validateInputPostFloat($var) // VALIDA NUMEROS FLOTANTES
	{
		$this->options = array(FILTER_FLAG_ALLOW_THOUSAND);
		return filter_input(INPUT_POST, $var, FILTER_VALIDATE_FLOAT, $this->options);
	}
	public function validateInputPostIp($var) // VALIDA DIRECCIONES IP
	{
		$this->options = array(FILTER_FLAG_IPV4);
		return filter_input(INPUT_POST, $var, FILTER_VALIDATE_IP, $this->options);
	}
	public function validateInputPostUrl($var) // VALIDA URL
	{
		$this->options = array(FILTER_FLAG_PATH_REQUIRED, FILTER_FLAG_QUERY_REQUIRED);
		return filter_input(INPUT_GET, $var, FILTER_VALIDATE_URL, $this->options);
	}
	public function validateInputPostDate($var) // VALIDA FORMATO DE FECHA
	{
		$this->options = array('options'=>array('regexp'=>'~^\d{2}/\d{2}/\d{4}$~')); // OPCION SIMPLE -> /\d{2}\/\d{2}\/\d{4}/
		return filter_input(INPUT_POST, $var, FILTER_VALIDATE_REGEXP, $this->options);
	}
	public function validateInputPostPhoneNumber($var) // VALIDA FORMATO TELEFONICO
	{
		$this->options = array('options'=>array('regexp'=>'/^[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}$/')); // OPCION SIMPLE -> /[^0-9]/ 
		return filter_input(INPUT_POST, $var, FILTER_VALIDATE_REGEXP, $this->options);
	}
}
?>