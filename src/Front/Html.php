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
namespace  LuckyPHP\Front;

/** Dependances
 * 
 */
use LuckyPHP\Http\Header;
use LuckyPHP\File\Json;

/** Class page
 * 
 */
class Html{

    /****************************************************************
     * Static methods
     */

    /** Print Message
     * @param string $message Message to print
     * @return void
     */
    public static function print(string $message = ""):void{

        # Start tag
        echo '<pre>';

        # Print message
        print_r($message);

        # End tag
        echo '</pre>';

    }

    /** Echo message
     * @param string $message Message to echo
     * @return void
     */
    public static function echo(string $message = ""):void{

        # Start tag
        echo '<pre>';

        # Print message
        echo($message);

        # End tag
        echo '</pre>';

    }

    /** Echo json message
     * @param string $message Message to echo as json 
     *  - if string given isn't a json, it will convert it
     * @return void
     */
    public static function echoJson(string $message = "", bool $exit = false):void {

        # Set header
        header(Header::CONTENT_TYPE['json']);

        # Echo message
        echo Json::check($message) ?
            $message :
                json_encode($message);

        # Check if exit
        if($exit)
            exit;

    }

}