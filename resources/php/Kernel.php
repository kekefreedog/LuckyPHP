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
use LuckyPHP\Server\SanityCheck;
use LuckyPHP\Server\Exception;
use LuckyPHP\Server\Config;
use LuckyPHP\Front\Console;
use LuckyPHP\Date\Chrono;


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

    /** Define Chrono
     * 
     */
    public function chronoStart(){

        # New Chrono
        $this->chrono = new Chrono();

    }

    /** Get Time execution
     * @param any $flag null | json | html
     */
    public function chronoStop($flag = null){

        # Stop chrono
        $this->chrono->stop();

        # If html
        if($flag == "html")

            # Get time clean
            Console::info('Page loaded in '.$this->chrono->getTime());

    }

    /** Define roots
     * 
     */
    public static function rootsDefine(){

        # Set default root
        Config::defineRoots([
            'app'       =>  __DIR__.'/../',
            'www'       =>  __DIR__.'/../html/',
            'html'      =>  __DIR__.'/../html/',
            'luckyphp'  =>  __DIR__.'/../vendor/kekefreedog/luckyphp/',
        ]);

    }

    /** Sanity Check
     * 
     */
    protected static function sanityCheck(){
        
        # Execute sanity check
        new SanityCheck([
            # Other checks to call
        ]);
        
    }

    /** Set config of the app
     * 
     */
    protected function configSet(){
        
        try {

            # Read config of the app
            $this->config = Config::read(Config::CONFIG_PATH['app']);

        }catch(Exception $e){

            # Mettre en place redirection
            echo 'Exception reçue : ',  $e->getMessage(), "\n";

        }

    }

    /** Set Context of the current request
     * 
     */
    protected function contextSet(){

        # Set context
        Config::defineContext(
            [
                # Chrono
                "script"    =>  [
                    'chrono'     => [
                        'start'     =>  $this->chrono->getStart()
                    ],
                ]
            ],
            true,
            true
        );
        
    }

    /** Initialisation of the cache
     * 
     */
    private function cacheInit(){

        # Set cache
        $this->cache = null;

    }

}