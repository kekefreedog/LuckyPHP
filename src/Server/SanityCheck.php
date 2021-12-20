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
namespace  LuckyPHP\Server;

/** Call other class
 * 
 */
use LuckyPHP\Server\Exception;

/** Class Sanity Check
 * 
 */
class SanityCheck{

    /** Check if PHP Version compatible with the app
     * 
     */
    public static function checkPHPVersion($minVersion = "7.0.0"){

        # Get current php version
        $version = phpversion();

        # Set result
        $result = version_compare($version, $minVersion, '>=');

        # Return error if result false
        if(!$result)

            throw new Exception("Please check the current PHP version is higher than $minVersion", 1);

        # Return true
        return true;

    }

    /** Check if MySQL Version compatible with the app
     * 
     */
    public static function checkMySQLVersion($minVersion = "1.0.0"){

        # Set result
        $result = true;

        # Return error if result false
        if(!$result)

            throw new Exception("Please check the current PHP version is higher than $minVersion", 1);

        # Return true
        return true;

    }

    /** Check if the current host is allowed
     * 
     */
    public static function checkHost(){

        # Get server name
        $serverName = $_SERVER['SERVER_NAME'];

        echo $serverName;

    }

}