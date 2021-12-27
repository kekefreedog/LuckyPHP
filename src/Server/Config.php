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

/** Class page
 * 
 * @dependance root 
 * 
 */
class Config{

    /** Read config
     * 
     */
    public static function read($input = ""):array {


        # If input is a path
        if(
            strpos($input, '/') !== false && 
            strpos($input, '.') !== false
        ){

            # Set path
            $path = __ROOT_APP__.$input;

            
        }else
        # If input is the name of the config
        if($input && in_array($input, self::CONFIG_PATH)){

            # Set path
            $path = __ROOT_APP__.self::CONFIG_PATH[$input];

        }else
        # Else error
        {

            # Set exception
            throw new Exception("You are trying to load an invalid config \"$input\"", 500);

        }

        # Check if file of the config exist
        if(!file_exists($path))
            
            # Set exception
            throw new Exception("The config you are trying to open doesn't exists \"$path\"", 500);

        # Parse the config
        return Yaml::parseFile($path);

    }

    /** Define roots
     * 
     * Define root from array
     * exemple of input :
     * [
     *      'app'       =>  $directory,
     *      'www'       =>  $directory.'www/',
     *      'luckyphp'  =>  $directory.'vendor/kekefreedog/luckyphp/',
     * ]
     * 
     * @param array $roots
     * 
     */
    public static function defineRoots(array $roots = []):bool {

        # Check array
        if(empty($roots))
            return false;

        # Iteration root
        foreach($roots as $rootName => $rootValue)

            # Check root name and root value
            if($rootName && $rootValue)

                # Define root
                define('__ROOT_'.strtoupper($rootName).'__', $rootValue);

        # Return true;
        return true;

    }

    /** Default file config
     * 
     */
    public const CONFIG_PATH = [
        'app'   =>  'config/app.yml',
        'routes'=>  'config/routes.yml',
        'page'  =>  'config/page.yml'
    ];

}