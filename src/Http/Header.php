<?php declare(strict_types=1);
/*******************************************************
 * Copyright (C) 2019-2021 Kévin Zarshenas
 * kevin.zarshenas@gmail.com
 * 
 * This file is part of Double Screen.
 * 
 * This code can not be copied and/or distributed without the express
 * permission of Kévin Zarshenas @kekefreedog
 *******************************************************/

/** Namespace
 * 
 */
namespace  Kutilities\Http;

/** Class page
 * 
 */
abstract class Header{

    /** Set a header
     * 
     */
    public function set(string $type = "") :bool {

        # Check if type is defined and is in constant
        if(!$type || !in_array($type, self::CONTENT_TYPE))

            # Return false
            return false;

        # Set header
        header("Content-Type: ".self::CONTENT_TYPE[$type]);

        # Return true
        return true;

    }

    /** Constant where is stored content type
     * 
     */
    const CONTENT_TYPE = [
        # Js
        'js'    =>  'application/javascript; charset=utf-8',
        # Json
        'json'  =>  'application/json',
        # Yaml
        'yml'   =>  'application/x-yaml'
    ];

}