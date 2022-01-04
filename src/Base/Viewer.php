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
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use LuckyPHP\Server\Exception;
use LightnCandy\LightnCandy;
use LuckyPHP\Front\Template;
use LuckyPHP\File\Json;


/** Class Viewer
 * 
 */
abstract class Viewer{

    /** Parameters
     * 
     */
    public $render = null;
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
            $e->getHtml();

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
            throw new Exception("No viewer constructor associate to \"$type\"", 500);

        # Set constructor
        $this->constructor = $name;

    }

    ##########################################################################



    /** Html constructor
     * 
     */
    private function constructorHtml(){

        # New template
        $template = new Template();

        # Build content of template
        $content = $template
            ->addDoctype()
            ->addHtmlStart()
                ->addHeadStart()
                    ->addHeadMeta()
                    ->addStylesheet()
                    ->addScriptJs("app")
                    ->setTitle()
                ->addHeadEnd()
                ->addBodyStart()
                    ->loadLayouts($this->controller->callback->getLayouts())
                    ->addScriptJs("bundle")
                ->addBodyEnd()
            ->addHtmlEnd()
            ->build()
        ;

        # Compile template
        if(!$compile = LightnCandy::compile($content, Template::lightnCandyInit()))
        
            # Set exception
            throw new Exception("Compilation of the html template failed", 500);

        # Prepare render
        $render = LightnCandy::prepare($compile);

        # Set global render
        $this->render = $render;

        # Render html
        $this->rendererHtml();

    }

    /** Renderer Html
     * 
     */
    public function rendererHtml(){

        # Check render
        if($this->render === null && $this->getResponseType() == "html")

            # Set exception
            throw new Exception("Template render failed. You must prepare your html template before render it.", 500);

        # Push render result in content
        $this->content = ($this->render)($this->controller->callback->getModelResult());

    }

    /** Data render
     * 
     */
    private function constructorData(){

        # Get result of modal
        $file = $this->controller->callback->getModelResult();

        # Check data response
        if(
            !$file['path'] ||
            !file_exists($file['path'])
        )
            # Generate empty error result depending of content type
            return;

        # Prepare file response
        $this->response = new BinaryFileResponse($file['path']);

        # Check header
        if($file['header'])

            # Iteration header
            foreach ($file['header'] as $name => $value)

                # Set Content Type
                $this->response->headers->set($name, $value);

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

        # Check no data
        if($this->getResponseType() != "data")

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