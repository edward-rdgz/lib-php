<?php
/* Author: E.J.P.C.R. - Date: 2015/10/04 */
class Cookie
{
	public function getCookie($name) // CONSIGUE EL VALOR DE LA COOKIE
	{
		if(isset($_COOKIE[$name]))
		{
			return $_COOKIE[$name];
		}
		else
		{
			return false;
		}
	}
	public function setCookie($name, $value, $expire = 3600, $path = '/', $domain = false) // ESTABLECE LOS DATOS DE LA COOKIE
	{
		$val = false;
		if(!headers_sent())
		{
			if($domain === -1)
			{
				$domain = $_SERVER['HTTP_HOST'];
			}
			if($expire === false)
			{
				$expire = 1893456000;
			}
			else if(is_numeric($expire))
			{
				$expire += time();	
			}
			else
			{
				$expire = strtotime($expire);
			}
			$val = setcookie($name, $value, $expire, $path, $domain);
		}
		return $val;
	}
	public function deleteCookie($name, $path = '/', $domain =  false) // ELIMINA LA COOKIE
	{
		$val = false;
		if(!headers_sent())
		{
			if($domain === false)
			{
				$domain = $_SERVER['HTTP_HOST'];
			}
			$val = setcookie($name, '', time() - 3600, $path, $domain);
			unset($_COOKIE[$name]);
		}
	}
	public function getAllCookies() // CONSIGUE TODAS LAS COOKIES
	{
		if(!empty($_COOKIE))
		{
			return array_keys($_COOKIE);
		}
		else
		{
			return false;
		}
	}
	public function deleteAllCookies() // ELIMINA TODAS LAS COOKIES
	{
		$cookies = $this->getAllCookies();
		if(!empty($cookies))
		{
			for($i = 0; $i < count($cookies); $i++)
			{
				$this->deleteCookie($cookies[$i]);
			}
		}
	}
}
?>