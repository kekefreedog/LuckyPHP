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

        # Sanity check
        if(!$this->sanityCheck) return;

        # Set config
        $this->config = Config::read('app');

        # Load Kmaterial.json
        $this->loadJson();

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
        if($this->config['app']['css']['framework']['package'] != "Kmaterialize")
            $result = false;

        # Return result
        return $result;

    }

    /** Load json
     * 
     */
    private function loadJson(){



    }

    /** Load components
     * 
     */
    private function loadComponents(){



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