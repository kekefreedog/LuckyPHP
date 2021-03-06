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
use Mezon\Router\Router AS MezonRouter;
use LuckyPHP\Server\Exception;
use LuckyPHP\Server\Config;
use LuckyPHP\Http\Request;
use LuckyPHP\Code\Strings;

/** Class page
 * 
 */
class Router{

    # Declare instance
    private $instance = null;

    # Routes config
    private $config = [];

    /** Constructor
     * 
     */
    public function __construct(Request $request){

        # New Rooter
        $this->instanceCreate();

        # Set Routes Config
        $this->configRoutesSet();

        # Request set
        $this->requestSet($request);

        # Push routes in Rooter
        $this->routerFill();

        # Execute Callback
        $this->routerExecute();

    }

    /** Create instance
     *  
     */
    private function instanceCreate(){
        
        # Set rooter instance
        $this->instance = new MezonRouter();

    }

    /** Set Routes Config
     * 
     */
    private function configRoutesSet(){
        
        try {

            # Get routes config
            $this->config = Config::read(Config::CONFIG_PATH['routes']);

        }catch(Exception $e){

            # Mettre en place redirection
            echo 'Exception reçue : ',  $e->getMessage(), "\n";

        }

        # Check or fill methods 
        $this->config['methods'] = isset($this->config['methods']) ?
            array_map('strtoupper', $this->config['methods']) :
                [];

    }

    /** Set request
     * 
     */
    private function requestSet(Request $request){

        # Set request
        $this->request = $request;

    }

    /** Put routes in router
     * 
     */
    private function routerFill(){

        # Check methods and routes
        if(empty($this->config['routes']) || empty($this->config['methods']))
            return false;

        # Iteration des routes
        foreach($this->config['routes'] as $key => $route){

            # Check route name
            $route['name'] = !isset($route['name']) || empty($route['name']) ?
                'route_'.$key :
                    $route['name'];

            # Convert route to array if string
            if(is_string($route['patterns'])) 
                $route['patterns'] = [$route['patterns']];

            # Convert methods to array if string
            if(is_string($route['methods']))
                $route['methods'] = [$route['methods']];

            # Check if * in methods
            if(in_array('*', $route['methods']))
                $route['methods'] =$this->config['methods'];

            # Filter methods by methods allowed
            $route['methods'] = array_filter(
                $route['methods'], 
                function($v){
                    return in_array(strtoupper($v), $this->config['methods']);
                }
            );

            # Check route and methods not empty
            if(empty($route['patterns']) || empty($route['methods']))
                continue;

            # Iteration des routes
            foreach($route['patterns'] as $pattern)

                # Iteration des methods
                foreach ($route['methods'] as $method) {

                    try{

                        # Check if call back exist
                        $callbackName = $this->routeCallbackCheck($route['name']);

                    }catch(Exception $e){

                        # Message html
                        $e->getHtml();
            
                    }

                    # Add Route in Router
                    $this->instance->addRoute(
                        $pattern,
                        function(string $currentRoute, array $parameters) use ($callbackName, $route){

                            # Execute callback
                            $this->constroller = new $callbackName(
                                $this->request,
                                $parameters,
                                $route, 
                                $currentRoute
                            );

                        },
                        strtoupper($method),
                        $route['name']
                    );

                }

        }

    }

    /** Check if class callback exists
     * 
     * @return string
     */
    public static function routeCallbackCheck($name, $exception = true){

        # Set name from arguments
        $name = "\App\Controllers\\".Strings::snakeToCamel(str_replace(" ", "_", $name), true)."Action";

        # Check class of callback exists
        if(!class_exists($name) && $exception)

            # Set exception
            throw new Exception("There is not class assiociate to the current root \"$name\"", 500);

        # Return name of the class
        return $name;

    }

    /** Execute callback
     * 
     */
    private function routerExecute($uri = ""){

        # Check current uri
        if(!$uri)
            $uri = $_SERVER['REQUEST_URI'];

        # Remove query string in uri
        $uri = strtok($_SERVER["REQUEST_URI"], '?');

        # Call courrent route
        $this->instance->callRoute($uri);

    }

    /** Get Reponse
     * 
     */
    public function getResponse(){

        # Return reponse
        return $this->constroller->response();

    }

    /** Get Reponse
     * 
     */
    public function getCallback(){

        # Return reponse
        return $this->constroller;

    }

}