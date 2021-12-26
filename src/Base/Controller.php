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

/** Class Controller
 * 
 */
abstract class Controller{

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

        # Set route
        $this->routePrepare([
            'current' =>  $arguments[0] ?? null,
            ...$arguments[1] ?? []
        ]);

        # Set request
        $this->requestPrepare($arguments[2] ?? null);

        # Set parameters
        $this->parametersPrepare([
            ...$arguments[3]
        ]);

    }

    /** Prepare route
     * 
     */
    private function routePrepare($array){

        # Set route
        $this->route = [
            'current'   =>  [
                'pattern'   =>  $array['current'],
                'method'   =>  $_SERVER['REQUEST_METHOD'],
                'name'      =>  $array['name'],
            ],
            'config'    =>  [
                'methods'   =>  $array['methods'],
                'patterns'  =>  $array['patterns'],
            ]
        ];

    }

    /** Prepare route
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

}