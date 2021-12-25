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
use Symfony\Component\HttpFoundation\Request;
use Mezon\Router\Router AS MezonRooter;
use LuckyPHP\Server\Config;
use LuckyPHP\Front\Html;

/** Class page
 * 
 * @dependance root 
 * 
 */
class Rooter{

    # Declare instance
    private $instance = null;

    # Routes config
    private $config = [];

    # Public
    public $request = null;

    /** Constructor
     * 
     */
    public function __construct(){

        # New Rooter
        $this->instanceCreate();

        # Set Routes Config
        $this->configRoutesSet();

        # Prepare request
        $this->requestPrepare();

        Html::print($this->config);
        
        Html::print($this->request);

    }

    /** Create instance
     *  
     */
    private function instanceCreate(){
        
        # Set instance
        $this->instance = new MezonRooter();

    }

    /** Set Routes Config
     * 
     */
    private function configRoutesSet(){
        
        try {

            # Get routes config
            $this->config = Config::read("config/routes.yml");

        }catch(Exception $e){

            # Mettre en place redirection
            echo 'Exception reçue : ',  $e->getMessage(), "\n";

        }

    }

    /** Prepare request
     * 
     */
    private function requestPrepare(){

        # Read request
        $this->request = Request::createFromGlobals();

    }


}