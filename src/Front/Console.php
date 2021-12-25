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

/** Class for Front Javascript Console
 * 
 */
abstract class Console{

    /** Display debug message
     * 
     */
    public static function debug($message){

        /* Display message */
        echo 
            '<script type="text/javascript">'.
                'console.debug('.
                    (
                        is_array($message) ?
                            json_encode($message) :
                                $message
                    ).
                ');'.
            '</script>'
        ;

    }

    /** Display debug message
     * 
     */
    public static function info($message){

        /* Display message */
        echo 
            '<script type="text/javascript">'.
                'console.info('.
                    (
                        is_array($message) ?
                            json_encode($message) :
                                $message
                    ).
                ');'.
            '</script>'
        ;

    }

    /** Display debug message
     * 
     */
    public static function log($message){

        /* Display message */
        echo 
            '<script type="text/javascript">'.
                'console.log('.
                    (
                        is_array($message) ?
                            json_encode($message) :
                                $message
                    ).
                ');'.
            '</script>'
        ;

    }

    /** Display debug message
     * 
     */
    public static function error($message){

        /* Display message */
        echo 
            '<script type="text/javascript">'.
                'console.error('.
                    (
                        is_array($message) ?
                            json_encode($message) :
                                $message
                    ).
                ');'.
            '</script>'
        ;

    }

    /** Display debug message
     * 
     */
    public static function warn($message){

        /* Display message */
        echo 
            '<script type="text/javascript">'.
                'console.warn('.
                    (
                        is_array($message) ?
                            json_encode($message) :
                                $message
                    ).
                ');'.
            '</script>'
        ;

    }

}