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

/** Class Viewer
 * 
 */
abstract class Viewer{

    /** Constructor
     * 
     */
    public function __construct(...$arguments){

        # Ingest arguments
        $this->argumentsIngest($arguments);

    }

    /** Ingest Arguments
     *
     */
    private function argumentsIngest($arguments){

        # Ingest controller
        $this->controller = $arguments[0];

        # Ingest Controler request
        $this->request = $arguments[0]->request;

        # Ingest Response
        $this->response = $arguments[0]->response;

        # Ingest config
        $this->config = $arguments[1] ?? [];

        # Ingest cache
        $this->cache = $arguments[2] ?? [];

    }

    /** Get response
     * 
     */
    public function getResponse(){

        # Return response
        return $this->response;

    }

    # Get Content Type
    public function getResponseType():string{
        return $this->controller->getResponseType();
    }

    # Get Content Type
    public function getContentType():string{
        return $this->controller->getContentType();
    }

}