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

    /** Default file config
     * 
     */
    public const CONFIG_PATH = [
        'settings'  =>  '../config/settings.yml'
    ];

}