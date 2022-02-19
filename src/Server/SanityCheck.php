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

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;
use LuckyPHP\Server\Exception;
use LuckyPHP\Server\Config;

/** Class Sanity Check
 * 
 */
class SanityCheck{

    /** Constructor
     * @* @param Array $others Others checks to execute
     */
    public function __construct(array $others = []){

        # Get App Config
        $config = Config::read("app");

        # Catch space
        try{

            # Check app > sanity
            if(
                isset($config['app']['sanity']) && 
                !empty($config['app']['sanity'])
            ):

                # Get methods of current class
                $methods = get_class_methods($this);

                # Iteration des methods
                foreach($methods as $method)

                    # Check methods start by check
                    if(
                        substr($method, 0, 5) == "check" &&
                        (
                            (
                                isset($config['app']['sanity'][strtolower(substr($method, 5))]) &&
                                $config['app']['sanity'][strtolower(substr($method, 5))]
                            )
                            ||
                            !isset($config['app']['sanity'][strtolower(substr($method, 5))])
                        ) 
                    )

                        # Execute method
                        $this->{$method}();

            endif;

            # Check others
            if(!empty($others))

                # Iteration others
                foreach($others as $function)

                    # Check if is function & if is allow in config > sanity
                    if(is_callable($function))

                        # Call function
                        $function();

        }catch(Exception $e){

            # Display html response
            echo "Validation of sanity check failed... 😟";

            # Exit
            exit;

        }

    }

    /**********************************************************************************
     * Check Methods
     */

    /** Check if the current host is allowed
     * 
     */
    public static function checkHosts(){

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

    /** Check Assets is compilated
     * @return bool
     */
    public static function checkAssets():bool{

        # Set result
        $result = true;

        # New finder
        $finder = new Finder();

        # List of folder to check
        $list = [ "css","js" ];

        # Push folders
        $folders = [];
        foreach(["/html/", "/wwww/"] as $folder)
            if(is_dir(__ROOT_APP__.$folder)) $folders[] = __ROOT_APP__.$folder;

        # Prepare finder
        $finder
            ->files()
            ->name('*.js')
            ->name('*.css')
            ->in($folders);
        ;

        # Check finder result
        if(!$finder->hasResults()){

            # New error
            throw new Exception("Check compilation of assets", 404);

            # Set result
            $result = false;

        }

        # Return result
        return $result;

    }

}