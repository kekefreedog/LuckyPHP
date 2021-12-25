<?php declare(strict_types=1);
/*******************************************************
 * Copyright (C) 2019-2021 Kévin Zarshenas
 * kevin.zarshenas@gmail.com
 * 
 * This file is part of LuckyPHP.
 * 
 * This code can not be copied and/or distributed without the express
 * permission of Kévin Zarshenas @kekefreedog
 *******************************************************/

/** Namespace
 * 
 */
namespace  LuckyPHP\Code;

/** Class Array 
 * 
 */
class Strings{

	/** Camel to Snake
	 * 
	 * 	result => toto_titi
	 * 
	 */
	public static function camelToSnake(string $input = ''):string {
		preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
		$ret = $matches[0];
		foreach ($ret as &$match) {
		  $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
		}
		return implode('_', $ret);
	}

	/** Snake to Camel
	 * 
	 * result =>
	 * 		totoTiti
	 * 		TotoTiti
	 * 
	 */
	public static function snakeToCamel($string = '', bool $capitalizeFirstCharacter = false):string {
		$str = str_replace(['_', ' '], '', ucwords($string, '_'));
		if (!$capitalizeFirstCharacter) {
			$str = lcfirst($str);
		}
		return $str;
	}

	/** Clean
	 * 
	 * src : https://www.codegrepper.com/code-examples/php/php+remove+all+special+characters+from+string
	 */
	public function clean(string $string = ''):string {
		/* Reg Ex */
		$utf8 = [
			'/[áàâãªä]/u'   =>   'a',
			'/[ÁÀÂÃÄ]/u'    =>   'a',
			'/[ÍÌÎÏ]/u'     =>   'i',
			'/[íìîï]/u'     =>   'i',
			'/[éèêë]/u'     =>   'e',
			'/[ÉÈÊË]/u'     =>   'e',
			'/[óòôõºö]/u'   =>   'o',
			'/[ÓÒÔÕÖ]/u'    =>   'o',
			'/[úùûü]/u'     =>   'u',
			'/[ÚÙÛÜ]/u'     =>   'u',
			'/ç/'           =>   'c',
			'/Ç/'           =>   'c',
			'/ñ/'           =>   'n',
			'/Ñ/'           =>   'n',
			'/\s+/'         =>   '_',
			'/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
			'/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
			'/[“”«»„]/u'    =>   ' ', // Double quote
			'/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160),
			'/[(]/'			=>	 '',  // Round brackets
			'/[)]/'			=>	 '',  // Round brackets
		];
		/* Return value */
		return strtolower(preg_replace(array_keys($utf8), array_values($utf8), $string));
	}

	/** Process data
	 * 
	 * @param string $url
	 */
	public function process_https(string $url = ''):string {
        
		# Check url start by https
        if(substr(trim($url), 0, 8) == "https://"):
        
            return trim($url);
            
		# Check url stat bu http
        elseif(substr(trim($url), 0, 7) == "http://"):
            
            return str_replace('http://', 'https://', trim($url));
            
		# Other case
        else:
            
            return 'https://'.trim($url);
            
        endif;

	}

	/** Check if is email
	 * 
	 * @param string $email
	 */
	public function process_email(string $email = ''):string {

		# check if email
		return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : '';

	}

	/** Check if is bool
	 * 
	 * @param string|bool $email
	 */
	public function process_bool($bool = false):bool {

		# check if email
		return filter_var($bool, FILTER_VALIDATE_BOOL) ? true : false;

	}
	

}