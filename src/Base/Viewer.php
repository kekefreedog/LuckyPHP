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
use LuckyPHP\Front\Html;
use LuckyPHP\File\Json;

/** Class Viewer
 * 
 */
abstract class Viewer{
    
    /****************************************************************
    * Parameters
    */

    # Package from the controller
    private $package = null;

    # Viewer process
    private $process = null;

    /****************************************************************
    * Constructor
    */
    public function __construct(...$arguments){

        # Load viewer process
        $this->prepareViewerProcess();

        # Ingest arguments
        $this->argumentsIngest($arguments);

    }
    
    /****************************************************************
    * Hooks
    */

    /** Run viewer
     * 
     */
    public function run(){

        # Send Response of Process
        $this->process->sendResponse();

    }
    
    /****************************************************************
    * Methods
    */

    /** Prepare Viewer Process
     * 
     */
    private function prepareViewerProcess(){

        # Set context response
        $contextRouteResponse = __CONTEXT__['route']['response'] ?? null;

        # Check context is allowed
        if(!in_array(strtolower($contextRouteResponse), self::CONTEXT_ROUTE_RESPONSE_ALLOWED))

            # new error
            throw new Exception("Type of repsonse of the current route is not valid.", 404);

        # Get class name of the viewer process
        $viewerProcessName = "\LuckyPHP\Viewer\\".ucfirst($contextRouteResponse);
        
        # Get Viewer process 
        $this->process = new ($viewerProcessName)();
        
    }

    /** Ingest arguments
     * 
     */
    private function argumentsIngest($arguments){

        # Set package : first argument
        $this->package = $arguments[0];

    }
    
    /****************************************************************
    * Children methods
    */
    
    /****************************************************************
    * Constants
    */

    # Context Route Response Allowed
    private const CONTEXT_ROUTE_RESPONSE_ALLOWED = [
        'crud',
        'data',
        'html',
        'json',
        'xml',
        'yaml'
    ];

}