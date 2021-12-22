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

/** Dependance
 * 
 */
use LuckyPHP\Server\Exception;
use Symfony\Component\Yaml\Yaml;

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

            throw new Exception("Please check the current PHP version is higher than $minVersion", 501);

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

            throw new Exception("Please check the current PHP version is higher than $minVersion", 501);

        # Return true
        return true;

    }

    /** Check if the current host is allowed
     * 
     */
    public static function checkHost(){

        # Get server name
        $serverName = $_SERVER['SERVER_NAME'];

        # Check if config > app exists
        if(file_exists(__ROOT_APP__.'config/app.yml')){

            # Declare reponse
            $result = true;

            # Parse config
            $configApp = Yaml::parseFile(__ROOT_APP__.'config/app.yml');

            # Set hosts allowed and excluded
            $hostAllowed = $configApp['app']['hosts']['allowed'] ?? ['*'];
            $hostExcluded = $configApp['app']['hosts']['excluded'] ?? [];

            /** 1. In allowed and in excluded
             * 
             */
            if(
                (
                    in_array($configApp, $hostAllowed) ||
                    in_array('*', $hostAllowed)
                ) && (
                    in_array($configApp, $hostExcluded) ||
                    in_array('*', $hostExcluded)
                )
            ){

                # Set result
                $result = false;

            }else
            /** 2. In allowed and not in excluded
             * 
             */
            if(
                (
                    in_array($configApp, $hostAllowed) ||
                    in_array('*', $hostAllowed)
                ) && (
                    !in_array($configApp, $hostExcluded) ||
                    !in_array('*', $hostExcluded)
                )
            ){

                # Set result
                $result = true;

            }else
            /** 3. Not in allowed and in excluded
             * 
             */
            if(
                (
                    !in_array($configApp, $hostAllowed) ||
                    !in_array('*', $hostAllowed)
                ) && (
                    in_array($configApp, $hostExcluded) ||
                    in_array('*', $hostExcluded)
                )
            ){

                # Set result
                $result = false;

            }else
            /** 4. Else not allowed and not exluded
             * 
             */
            if(
                (
                    !in_array($configApp, $hostAllowed) ||
                    !in_array('*', $hostAllowed)
                ) && (
                    !in_array($configApp, $hostExcluded) ||
                    !in_array('*', $hostExcluded)
                )
            ){

                # If empty hostAllowed and hostExcluded
                if(empty($hostAllowed) && empty($hostExcluded)){

                    # Set result
                    $result = true;

                }else{

                    # Set result
                    $result = false;

                }

            }

            # Check if current host is not allowed
            if(!$result)

                throw new Exception("The current host \"$serverName\" is not allowed by the current app", 1);

        }

    }

}