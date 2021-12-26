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

/** LuckyPHP
 * 
 */
namespace  LuckyPHP\File;

/** Dependances
 * 
 */
use LuckyPHP\Server\Exception;

/** Class for manage the workflow of the app
 * 
 */
class Json{

    /** Is Convertible in Json
     * 
     * @return bool
     */
    public static function isConvertible($input):bool {

        # Declare Reponse
        $reponse = true;

        # Check if is string
        if(is_string($input) || is_numeric($input)):

            # Set exception
            throw new Exception("You are trying to convert a non-array element to Json", 500);

            # Set reponse
            $reponse = false;

        endif;
        
        # Retorune reponse
        return $reponse;

    }

    /** Check if input is json
     * 
     */
    public static function check($string):bool {
		if(is_array($string)) return false;
		json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE);
	}

}