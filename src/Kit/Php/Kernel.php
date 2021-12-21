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

/** Dependance
 * 
 */
use LuckyPHP\Server\Config;
use LuckyPHP\Server\Exception;
use LuckyPHP\Server\SanityCheck;


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

    /** Define roots
     * 
     */
    public static function rootsDefine(){

        # Set default root
        Config::defineRoots([
            'app'       =>  __DIR__.'/../',
            'www'       =>  __DIR__,
            'luckyphp'  =>  __DIR__.'/vendor/kekefreedog/luckyphp/',
        ]);

    }

    /** Sanity Check
     * 
     */
    protected static function sanityCheck(){
        
        try {

            # Check PHP version
            SanityCheck::checkPHPVersion("7.0.0");

            # Check Host is allowed
            SanityCheck::checkHost();

            # Check MySQL version
            SanityCheck::checkMySQLVersion("1.0.0");

        }catch(Exception $e){

            # Mettre en place redirection
            echo 'Exception reçue : ',  $e->getMessage(), "\n";

        }
        
    }

    /** Set config of the app
     * 
     */
    protected function configSet(){
        
        try {

            # Read config settings
            $this->config[Config::CONFIG_PATH['settings']] = Config::read(Config::CONFIG_PATH['settings']);

        }catch(Exception $e){

            # Mettre en place redirection
            echo 'Exception reçue : ',  $e->getMessage(), "\n";

        }


        /* * * Read custom config
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