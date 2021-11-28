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
	public function in_array_strpos(array $array = [], string $needle = ""):bool {

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
    function filter_by_key_value($array, $key, $keyValue){
		return array_filter($array, function ($var) use ($keyValue, $key) {
			return ($var[$key] == $keyValue);
		});
	}

}