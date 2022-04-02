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
namespace  LuckyPHP\Viewer;

/** Dependances
 * 
 */
use Symfony\Component\HttpFoundation\Response;
use LuckyPHP\Interface\ViewerProcess;
use LuckyPHP\Http\Header;

/** Class page
 * 
 */
class Html implements ViewerProcess{

    /****************************************************************
    * Parameters
    */

    # Response
    private $response = null;

    /****************************************************************
    * Constructor
    */
    public function __construct(){

        # Prepare Response
        $this->prepareResponse();
        
    }

    /****************************************************************
    * Hooks
    */

    /** Set header
    * - Set header of the viewer
    * @param string|null $contentType Name of the content type
    * @return void
    */
    public function setHeader(string|null $contentType = null):void{

        # Set content type
        $this->response->headers->set(
            'Content-Type', 
            Header::getContentType("html")
        );

    }

    /** Send Response
     * @return void
     */
    public function sendResponse():void{

        # Send Response
        $this->response->send();

    }

    /****************************************************************
    * Methods
    */

    # Response
    private function prepareResponse(){

        # New Response object
        $this->response = new Response();

    }

    /****************************************************************
    * Constants
    */

    # Need Package
    public const NEED_PACKAGE = true;

}