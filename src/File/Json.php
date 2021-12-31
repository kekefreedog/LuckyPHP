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

    /** Open Json File
     * Open json file and return its content decodes
     * @param string $filename
     * @param bool $arrayFormat decode as array (else as object)
     */
    public static function open(string $filename = "", bool $arrayFormat = true):array|null{

        # Check filename
        if(!$filename)
            return null;
        
        # Check if file exist
        if(!file_exists($filename))

            # Set exception
            throw new Exception("Json file \"$filename\" doesn't exists.", 404);

        # Get content of file
        $content = file_get_contents($filename);

        # Check if content is json
        if(!Json::check($content))

            # Set exception
            throw new Exception("Content of \"$filename\" is not a valid Json.", 500);

        # Decode content
        $result = json_encode($content, $arrayFormat ? 1 : 0);

        # Return result
        return $result;
        
    }

}