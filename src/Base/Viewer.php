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
use LuckyPHP\Front\Template;
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
    public $constructor = null;

    /** Constructor
     * 
     */
    public function __construct(...$arguments){

        # Ingest arguments
        $this->argumentsIngest($arguments);

        # ResponsePrepare
        $this->responsePrepare();

        try{

            # Redirect to the constructor depending reponse type
            $this->getConstructor();

            # Execute constructor of current type
            $this->{$this->constructor}();

        }catch(Exception $e){

            # Mettre en place redirection
            echo 'Exception reçue : ',  $e->getMessage(), "\n";

        }

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
        $this->callback = $arguments[3];

    }

    /** Get name of to constructor depending of type of file
     * 
     */
    private function getConstructor(){

        # Get type
        $type = ucfirst($this->getResponseType());

        # Set name of the constructor
        $name = "constructor$type";

        # check methods exist
        if(!method_exists($this, $name))

            # Set exception
            throw new Exception("No constructor associate to \"$type\"", 500);

        # Set constructor
        $this->constructor = $name;

    }

    ##########################################################################



    /** Html constructor
     * 
     */
    private function constructorHtml(){

        $layouts = [
            "test"
        ];

        # New template
        $template = new Template();

        $content = $template
            ->addDoctype()
            ->addHtmlStart()
                ->addHeadStart()
                    ->addHeadMeta()
                    ->setTitle()
                ->addHeadEnd()
                ->addBodyStart()
                    ->loadLayouts($layouts)
                    ->addIndexJs()
                ->addBodyEnd()
            ->addHtmlEnd()
            ->build()
        ;

        # Set global content
        $this->content = $content;

    }

    /** Json constructor
     * 
     */
    private function constructorJson(){

        # Set content
        $content = json_encode(['message'=>'hello']);

        # Set global content
        $this->content = $content;

    }

    ##########################################################################

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
            ($this->callback)($this->getResponseType());

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