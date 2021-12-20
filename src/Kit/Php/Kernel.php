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
namespace App;

/** Use others classs
 * 
 */
use LuckyPHP\Server\SanityCheck;
use LuckyPHP\Server\Config;


/** Class for manage the workflow of the app
 * 
 */
class Kernel{

    /** Constructor
     * 
     */
    public function __construct(){
        
        # Init cache
        $this->cacheInit();

    }

    /** Sanity Check
     * 
     */
    protected static function sanityCheck(){

        # Check PHP version
        SanityCheck::checkPHPVersion("7.0.0");

        # Check Host is allowed
        SanityCheck::checkHost();

        # Check MySQL version
        SanityCheck::checkMySQLVersion("1.0.0");
        
    }

    /** Set config of the app
     * 
     */
    protected function configSet(){

        # Declare config parameters
        $this->config = [];

        # New config
        $config = new Config();

        # Read config settings
        $this->config[$config::CONFIG_PATH['settings']] = $config->read($config::CONFIG_PATH['settings']);


        /* * * Read custom config
        * -------------------------------------- *
        */

        # Set __...__
        
        /*
        * -------------------------------------- *
        * * */

        # Set default root
        Config::defineRoots([
            'app'       =>  __DIR__.'/../',
            'www'       =>  __DIR__,
            'luckyphp'  =>  __DIR__.'/vendor/kekefreedog/luckyphp/',
        ]);

        /* * * Define custom name constant
        * -------------------------------------- *
        */

        # Set __...__
        
        /*
        * -------------------------------------- *
        * * */

    }

    /** Initialisation of the cache
     * 
     */
    private function cacheInit(){

        # Set cache
        $this->cache = null;

    }

}