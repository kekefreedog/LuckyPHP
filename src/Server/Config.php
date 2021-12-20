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
    public function read($fileOrName = ""):array {

        # Check server Root
        if(!isset($this->serverRoot) || !$this->serverRoot)

            // Set server root
            $this->serverRoot = (new Root)->get();

        # If file
        if(
            strpos($fileOrName, '/') !== false && 
            strpos($fileOrName, '.') !== false
        )

            # Set path
            $path = str_replace(
                ["{{root}}", " "],
                [$this->serverRoot['directory'], ''],
                $fileOrName
            );

        elseif($fileOrName && in_array($fileOrName, self::CONFIG_PATH))

            # Set path
            $path = self::CONFIG_PATH[$fileOrName];

        else

            # Return false
            return [];

        # Parse file
        $value = file_exists($path) ? 
            Yaml::parseFile($path) : 
                [];

        # Return $value
        return $value;


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
        'settings'  =>  '../config/settings.yml'
    ];

}