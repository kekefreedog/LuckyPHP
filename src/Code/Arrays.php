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
class Arrays{

	/** In Array Strpos
     * 
     * Check if key contains needle
	 * 
	 */
	public static function in_array_strpos(array $array = [], string $needle = ""):bool {

		# Set reponse
		$reponse = false;

		# Check array
		if(!empty($array))

			# Iteration array
			foreach ($array as $value)
			
				# Check is strpos
				if(is_string($value) && strpos($value, $needle) !== false)

					$reponse = true;

		# Return reponse
		return $reponse;

	}

    /** Filter array by key value
     * 
     */
    public static function filter_by_key_value($array, $key, $keyValue){
		return array_filter($array, function ($var) use ($keyValue, $key) {
			return ($var[$key] == $keyValue);
		});
	}

	/** Array Stretch
	 * 
	 * @param string $separator by default "__"
	 * @param array $array array to process
	 * @return array
	 */
	public static function stretch($array = [], $separator = "_"):array {

		# Iteration
		foreach($array as $k => $v)

			# Check if separator in key
			if(strpos($k, $separator) !== false):

				# Explode key
				$explode = explode($separator, $k, 2);

				# Set array
				$array[$explode[0]] = self::stretch(
					[
						$explode[1] => $v
					],
					$separator
				);

				# Unset old key
				unset($array[$k]);
			
			endif;

		# Return array
		return $array;

	}

}