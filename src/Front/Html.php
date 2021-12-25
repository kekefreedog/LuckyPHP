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

/** Class page
 * 
 */
abstract class Html{

    /** Print Message
     * 
     */
    public static function print($message){

        # Start tag
        echo '<pre>';

        # Print message
        print_r($message);

        # End tag
        echo '</pre>';

    }
}