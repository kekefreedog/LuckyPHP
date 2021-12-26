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
use Symfony\Component\HttpFoundation\Response;

/** Class Viewer
 * 
 */
abstract class Viewer{

    /** Parameters
     * 
     */
    public $content = null;
    public $response = null;
    public $callback = null;

    /** Constructor
     * 
     */
    public function __construct(...$arguments){

        # Ingest arguments
        $this->argumentsIngest($arguments);

        # ResponsePrepare
        $this->responsePrepare();

    }

    /** Ingest Arguments
     *
     */
    private function argumentsIngest($arguments){

        # Ingest controller
        $this->controller = $arguments[0];

        # Ingest Controler request
        $this->request = $arguments[0]->request;

        # Ingest Data
        $this->data = $arguments[0]->response;

        # Ingest config
        $this->config = $arguments[1] ?? [];

        # Ingest cache
        $this->cache = $arguments[2] ?? [];

        # Ingest callback
        $this->callback = $arguments[4] ?? null;

    }

    /** Prepare Response
     * 
     */
    private function responsePrepare(){

        # New response
        $this->response = new Response(
            $this->content,
            Response::HTTP_OK,
            ['content-type' => $this->getContentType()]
        );

    }

    /** Execute Response
     * 
     */
    public function reponseExecute(){

        # Execute callback
        if($this->callback !== null)
            ($this->callback)();

        # Prepare response
        $this->response->send();

    }

    /** Get data
     * 
     */
    public function getData(){

        # Return response
        return $this->data;

    }

    # Get Content Type
    public function getResponseType():string{
        return $this->controller->callback->getResponseType();
    }

    # Get Content Type
    public function getContentType():string{
        return $this->controller->callback->getContentType();
    }

}