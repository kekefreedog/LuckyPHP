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
namespace  LuckyPHP\Http;

/** Class page
 * 
 */
abstract class Header{

    /** Set a header
     * 
     */
    public static function set(string $type = "") :bool {

        # Check if type is defined and is in constant
        if(!$type || !in_array($type, self::CONTENT_TYPE))

            # Return false
            return false;

        # Set header
        header("Content-Type: ".self::CONTENT_TYPE[$type]);

        # Return true
        return true;

    }

    /** Get Content type value
     * - Depending of the type given
     * 
     * @param string $type
     * @return string
     */
    public static function getContentType(string $type = ""):string {

        # Check if type is defined and is in constant
        if(!$type || !array_key_exists($type, Header::CONTENT_TYPE))

            # Return false
            return "";

        # Set response
        $reponse = Header::CONTENT_TYPE[strtolower($type)];

        # Return response
        return $reponse;

    }

    /** Check if header of url exists
     * @param string $url Needle url
     * @return bool
     */
    public static function exist(string $url = ""):bool{

        # Check if external url
        $external_url = (strpos("://", $url) !== false) ?
            true :
                false;

        # Get url header
        $url_headers = @get_headers((
            $external_url ? "" : __ROOT_APP__ ).$url
        );

        # Check url header result and set result
        $result = (
            !$url_headers || 
            strpos('404 Not Found', $url_headers[0]) !== false
        ) ?
            false : 
                true;

        # Return result
        return $result;

    }


    /** Constant where is stored content type
     * 
     */
    const CONTENT_TYPE = [
        # Html
        'html'  =>  'text/html',
        # Js
        'js'    =>  'application/javascript',
        # Json
        'json'  =>  'application/json',
        # Yaml
        'yml'   =>  'application/x-yaml'
    ];

}