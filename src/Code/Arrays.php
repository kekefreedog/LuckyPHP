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
	public static function stretch($array = [], $separator = "_") {

		# Declare result as array
		$result = [];
	
		# Check array
		if(is_array($array) && !empty($array))
	;
			# Iteration
			foreach($array as $k => $v)

				# Check if separator in key
				if(strpos($k, $separator) !== false){

					# Explode key
					$explode = explode($separator, $k, 2);
					
					# Declare new dimension array
					if(!isset($result[$explode[0]]))
						$result[$explode[0]] = [];
						
					# Set value and call function recursively
					$result[$explode[0]] = array_merge_recursive(
						$result[$explode[0]],
						self::stretch([$explode[1]=>$v], $separator)
					);
				
				}else
					
					# Set value of the current key
					$result[$k] = $v;
	
		# Return array
		return $result;
	
	}

	/** Convert array with attributes to string
	 * @param array $array
	 * @return string
	 */
	public static function to_string_attributes($array = []):string {
		$result = "";
		if(is_array($array))
			foreach ($array as $k => $v){
				$result .= " $k"; // Push key
				if(!empty($v))
					$result .= "=\"".(is_array($v)?implode(" ",$v):$v)."\"";
			}
		return $result;
	}

	/** array sort in stretch array
	 * @param array &$array Array to sort
	 * @param string $col Col to filter
	 * @param string $colSub Col child of col
	 * @param int $dir Direction of sort 
	 * @return void
	 */
	public static function array_sort_by_column(array &$arr = [], string $col = "", string $colSub = "", int $dir = SORT_ASC):void {

		# Declare sort col
		$sort_col = [];
		
		# Delcare k
		$i = "a";

		# Check array
		if(empty($arr))
			return;

		# Iteration array
		foreach ($arr as $key => $row){

			# Set value
			$value = $colSub ? 
			($row[$col][$colSub] ?? $i) : 
				($row[$col] ?? $i);
			$value = $value == null ? $i : $value;

			# set col
			$sort_col[$key] = $value;
			
			# Increment i
			if($value == $i)
				$i++;
			
		}

		# Sort array
		array_multisort($sort_col, $dir, $arr);

	}

}