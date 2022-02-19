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
namespace LuckyPHP\Extra\Kmaterialize;

/** Use other library
 * 
 */
use LuckyPHP\Server\Config;

/** Class Setup
 * 
 */
class Setup{

    /** Config
     * 
     */
    private $config;

    /** Constructor
     * @return void
     */
    public function __construct(){

        # Set config
        $this->config = Config::read('app');

        # Sanity check
        if(!$this->sanityCheck()) return;

        # Load Kmaterial.json
        $this->loadJson();

        # Load components (hbs...)
        $this->loadComponents();

    }

    /** Sanity check
     * Check conditions for continue to setup Kmaterialize in your app
     * @return bool
     */
    private function sanityCheck():bool{

        # Set Result
        $result = true;

        # Check folder exists
        if(!is_dir(__ROOT_APP__.self::PATH_KMATERIALIZE))
            $result = false;

        # Check in config app
        if(
            !isset($this->config['app']['css']['framework']['package']) ||
            $this->config['app']['css']['framework']['package'] != "Kmaterialize"
        )
            $result = false;

        # Return result
        return $result;

    }

    /** Load json
     * 
     */
    private function loadJson(){

        # Set theme
        $theme = $this->config['app']['css']['framework']['theme'] ?? false;

        # Check theme
        if(!$theme)
            # Stop call
            return;

        # Set json path
        $jsonPath = __ROOT_APP__.self::PATH_KMATERIALIZE."dist/css/$theme/kmaterial.json";

        # Check file exists
        if(is_file($jsonPath))

            # Copy file in json
            copy($jsonPath, __ROOT_APP__."resources/json/kmaterial.json");
        

    }

    /** Load components
     * 
     */
    private function loadComponents(){

        # Source
        $source = __ROOT_APP__.self::PATH_KMATERIALIZE."/dist/hbs/";

        # Target
        $target = __ROOT_APP__."/resources/hbs/";

        # List of elements to copy
        $schema = [
            "miscellaneous" =>  [
                "error.hbs",
            ],
            "page"          =>  [
                "home.hbs"
            ],
            "structure"     =>  [
                "head.hbs",
                "main.hbs",
                "sidenav.hbs"
            ]
        ];

        # Iteration schema
        foreach($schema as $folder => $content):

            # Create folder
            mkdir($target.$folder, 0777, true);

            # Iteration of content
            foreach($content as $file)

                # Check file exist
                if(!file_exists("$source.$folder/$file"))

                    # Copy
                    copy("$source.$folder/$file", "$target/$folder/$file");

        endforeach;

    }

    /** Load styles
     * 
     */
    private function  loadStyles(){



    }

    /** Path of Kmaterialize
     * 
     */
    private const PATH_KMATERIALIZE = "/node_modules/Kmaterialize";

}