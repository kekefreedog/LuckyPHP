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

/** Dependances
 * 
 */
use LuckyPHP\Server\Exception;

/** Dependance
 * 
 */
use Symfony\Component\HttpFoundation\Response;
use LuckyPHP\File\Json;

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

        print_r($this->getContentType());

    }

    /** Set response content
     * 
     */
    public function setResponseContent(){

        # Set content
        $this->response->setContent($this->content);

    }

    /** Execute Response
     * 
     */
    public function reponseExecute(){

        # Get content
        $content = $this->response->getContent();

        # Check content type Json
        if(
            $this->getResponseType() == "json" && 
            !Json::check($content)
        )

            # Set exception
            throw new Exception("Your content must be a Json if you want return a Json", 500);

        # Execute callback if not null
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