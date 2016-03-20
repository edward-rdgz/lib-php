<?php
/* Author: E.J.P.C.R. - Date: 2015/10/04 */
class Tool
{
	public function palindrome($str) // ANALIZA EL PALINDROMO
	{
		(string)$str; // TRATA COMO STRING EL PARAMETRO ENVIADO
		if(strlen($str) == 1)
		{
			return true;
		}
		else
		{
			if(strrev($str) == $str) // VERIFICA SI ES IGUAL EN AMBOS SENTIDOS
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
	}
	public function cleanString($str) // LIMPIA LA CADENA DE TEXTO
	{
		$str = strip_tags($str); // ETIQUETAS HTML
		$str = str_replace(' ', '', strtolower($str)); // ESPACIOS
		$p = array('/á/', '/é/', '/í/', '/ó/', '/ú/'); // ACENTOS
		$r = array('a', 'e', 'i', 'o', 'u');
		$str = preg_replace($p, $r, $str); // REMPLAZA VALORES
		$p = array('/&aacute/', '/&eacute;/', '/&iacute;/', '/&oacute;/', '/&uacute;/'); // ACENTOS HTML
		$r = array('a', 'e', 'i', 'o', 'u');
		$str = preg_replace($p, $r, $str);  // REMPLAZA VALORES
		$str = preg_replace('/%&.+?;/', '', $str); // SIGNOS DE PUNTUACION
		$str =  preg_replace(',', '', $str); // REMPLAZA VALORES
		return $str;
	}
	public function encryptString($str, $mode = 'md5') // ENCRIPTA LA CADENA DE TEXTO
	{
		if(in_array($mode, hash_algos())) // BUSCA EL TIPO DE ENCRIPTADO EN EL DICCIONARIO DE ALGORITMOS
		{
			$out = hash($mode, $str); // HACE LA CONVERSION AL TIPO DE ENCRIPTACION
			return $out;
		}
		else
		{
			return "Error algoritmo no soportado";
		}
	}
	public function encodeString($str, $mode = 'sha1') // ENCRIPTA LA CADENA DE TEXTO CON UNA SALT
	{
		$saltLength = 5; // VARIABLE DE LONGITUD PRIVADA
		$salt = substr(uniqid(rand(), true), 0, $saltLength); // SE GENERA EL SALTO ALEATORIO CON LA LONGITUD DEFINIDA
		if(in_array($mode, $hash_algos()))
		{
			$out = hash($mode, $salt.$str); // SE GENERA EL PICADILLO DE LA CADENA JUNTO CON LA SALT
			return $saltLength.$out.$salt;
		}
		else
		{
			echo "Error algoritmo no soportado";
		}
	}
	public function decodeHash($str) // SEPARA EL CIFRAMIENTO DE LA CADENA DE TEXTO
	{
		$decode['length'] = substr($str, 0, 1); // LONGITUD DE LA SEMILLA
		$decode['hash'] = substr($str, 1, strlen($str) - ($decode['length'] + 1)); // PICADILLO
		$decode['salt'] = str_replace($decode['hash'], '', substr($str, 1)); // SEMILLA
		return $decode;
	}
	public function randomString($length = 15) // GENERA CONTRASEÑA O CADENA DE TEXTO ALEATORIA
	{
		$charValidate = array("b", "B",  "c", "C", "d", "D", "f", "F", "g", "G", "h", "H", "j", "J", "k", 
		"K", "l", "L", "m", "M", "n", "N", "p", "P", "q", "Q", "r", "R", "s", "S", "t", "T", "v", "V", "w", "W",
		"x", "X", "y", "Y", "z", "Z", "a", "A", "e", "E", "i", "I", "o", "O", "u", "U", ".", "/", "$", "!", "@",
		"#", "%", "(", ")", "&", "\\", "=", "+", "[", "]", "{", "}", ":", ";", ",", "^", "*", "-", " ", "0", "1",
		"2", "3", "4", "5", "6", "7", "8", "9");
		$i = 0;
		$randStr = "";
		while($i < $length)
		{
			shuffle($charValidate); // MEZCLA LOS DATOS
			$char = $charValidate[mt_rand(0, count($charValidate)-1)];
			if(!strstr($randStr, $char))
			{
				$randStr .= $char;
				$i++;
			}
		}
		return $randStr;
	}
	public function safetyString($str) // MIDE LA SEGURIDAD DE LA CADENA DE TEXTO
	{
		$security = 0;
		if(strlen($str) >= 8) // VERIFICA LA LINGITUD DE LA CADENA DE TEXTO
		{
			$security++;
		}
		if(strlen($str) >= 16)
		{
			$security++;
		}
		if(strtoupper($str) != $str) //  VERIFICA QUE TENGA MAYUSCULAS Y MINUSCULAS
		{
			$security++;
		}
		preg_match_all('/[!@#$%&*\/=?,;.:\-_+^\\\]/', $str, $symbols); // VERIFICA CUANTOS SIMBOLOS CONTIENE
		$security += sizeof($symbols[0]);
		$unique = sizeof(array_unique(str_split($str))); // VERIFICA CARACTERES UNICOS
		$security += $unique;
		$strLength = str_split($str); // VERIFICA CANTIDAD DE CARACTERES IGUALES CONSECUTIVOS
		$consec = 0;
		for($i = 1; $i < count($strLength); $i++)
		{
			if($strLength[$i-1] == $strLength[$i])
			{
				$consec++;
			}
		}
		$security = $security - $consec;
		return $security;
	}
}
?>