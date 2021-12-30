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
namespace  LuckyPHP\Base;

/** Dependance
 * 
 */
use LuckyPHP\Http\Header;
use App\Model;

/** Class Controller
 * 
 */
abstract class Controller{

    /** content parameters
     * 
     */
    public $content;

    /** Constructor
     * 
     */
    public function __construct(...$arguments){

        # Ingest arguments
        $this->argumentsIngest($arguments);
        
    }

    /** Ingest arguments
     * 
     */
    private function argumentsIngest($arguments){
        
        # Set request
        $this->requestPrepare($arguments[0] ?? null);

        # Set parameters
        $this->parametersPrepare([
            ...$arguments[1]
        ]);

        # Set route
        $this->routePrepare([
            'current' =>  $arguments[3] ?? null,
            ...$arguments[2] ?? []
        ]);

    }

    /** Prepare route
     * 
     */
    private function routePrepare($array){

        # Set route
        $this->route = [
            'current'   =>  [
                'pattern'   =>  $array['current'] ?? null,
                'method'    =>  $_SERVER['REQUEST_METHOD'] ?? null,
                'name'      =>  $array['name'] ?? null,
            ],
            'config'    =>  [
                'methods'   =>  $array['methods'] ?? [],
                'patterns'  =>  $array['patterns'] ?? [],
                'response'   =>  [
                    'default'       =>  $array['response'] ?? null,
                    'Content-Type'  =>  (!isset($array['response']) || $array['response'] === null) ?
                        null :
                            Header::getContentType($array['response'])
                ]
            ]
        ];

    }

    /** Prepare request
     * 
     */
    private function requestPrepare($obj){

        # Set route
        $this->request = $obj;

    }

    /** Prepare route
     * 
     */
    private function parametersPrepare($array){

        # Set route
        $this->request = $array;

    }

    /**
     *  Public action
     */

    # Set Get Route Pattern
    public function getRoutePattern():string{
        return $this->route['current']['pattern'] ?? "";
    }

    # Set Get Route Method
    public function getRouteMethod():string{
        return $this->route['current']['method'] ?? "";
    }

    # Set Get Route Method
    public function getRouteName():string{
        return $this->route['current']['name'] ?? "";
    }

    # Set Get All Method Allowed
    public function getRouteMethods():array{
        return $this->route['config']['methods'] ?? [];
    }

    # Set Get All Patterns Allowed for the current root
    public function getRoutePatterns():array{
        return $this->route['config']['patterns'] ?? [];
    }

    # Get Content
    public function getContent(){
        return $this->content;
    }

    # Get Content Type
    public function getResponseType():string{
        return $this->route['config']['response']['default'];
    }

    # Get Content Type
    public function getContentType():string{
        return $this->route['config']['response']['Content-Type'];
    }

    /**********************************************************************************
     * Modal
     */

    # Parameters for modal
    protected $modal;

    /** New Modal
     * Create new modal object
     * @return null
     */
    public function newModal(){

        # Set modal
        $this->modal = new Model();

    }

}