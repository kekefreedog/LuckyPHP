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
use Symfony\Component\Finder\Finder;
use LuckyPHP\Server\Config;
use LuckyPHP\Code\Strings;

/** Class route
 * 
 */
class Router{    
    
    /**********************************************************************************
    * Parameters
    */

    # Router instance
    private $instance = null;

    # Liste of Router
    private $routerList = [];

    # Path of the router cache
    private $routerCachePath = null;

    /** Router instance
     * 
     */
    
    /**********************************************************************************
    * Constructor
    */
    public function __construct(){
        
        # Load routers
        $this->loadRouters();

        # Execute routers
        $this->setCurrentRouterCallback();

    }
    
    /**********************************************************************************
    * Hooks
    */

    /** Run call back of current route
     * @param string $request_uri Custom request url to call
     */
    public function run(string $request_uri = ""){

        # Set request depending of request uri given
        $request = $request_uri ?
            $request_uri :
                $_SERVER['REQUEST_URI'];

        # Clean get variables
        $request = strtok($request, '?');

        # $this->instance->callRoute('/index/');

        # Get callback
        $callback = $this->instance->getCallback($request);

        # Check callback
        if($callback)

            # Run callback
            new $callback();

        else

            # return false
            return false;

    }
    
    /**********************************************************************************
    * Methods
    */

    /** Load routers
     * - Check cache
     * - Write cache if necessary
     * - Load cache
     * 
     */
    private function loadRouters(){

        # New router instance
        $this->instance = new MezonRouter();

        # Load router cache is exists
        $this->_loadRouterCache();

        # Load routers list
        $this->_loadRoutersList();

    }

    /** Set current router callback
     * - Get call back of current router
     * 
     */
    private function setCurrentRouterCallback(){



    }
    
    /**********************************************************************************
    * Children methods
    */

    /** Load Router cache
     * @return void
     */
    private function _loadRouterCache():void{

        # Build folder if not exists
        if(!is_dir(__ROOT_APP__.self::PATH_CACHE))
            mkdir(__ROOT_APP__.self::PATH_CACHE, 0777, true);

        # Prepare finder search
        $finder = new Finder();
        $finder
            ->files()
            ->name(['*_cache.php'])
            ->in(__ROOT_APP__.self::PATH_CACHE)
            ->sortByName()
            ->reverseSorting()
        ;

        # Check if any result
        if($finder->hasResults())

            # Iteration des fichier
            foreach($finder as $file){

                # Check router file has been change since last cache
                $modifiedDateConfig = date("YmdHis", filemtime(__ROOT_APP__."/config/routes.yml"));
                $modifiedDateCache = explode("_", $file->getFilenameWithoutExtension())[0];
                if($modifiedDateConfig <= $modifiedDateCache)

                    # Load cache
                    $this->routerCachePath = $file->getRealPath();

                # Stop after first file
                break;

            }

    }

    /** Load routers list
     * @return void
     */
    private function _loadRoutersList():void {

        # Check if cache path
        if($this->routerCachePath):

            # Load cache
            $this->instance->loadFromDisk($this->routerCachePath);

            # Stop loader
            return;

        endif;

        # Fill routes
        $this->_fillRoutersList();

        # Save routers in cache
        $this->_saveRoutersListInCache();

    }

    /** Fill routers list
     * @return void
     */
    private function _fillRoutersList(){

        # Check methods and routes
        $this->routerList = Config::read('routes');

        # Get methods
        $methods = $this->routerList['methods'];
        
        # Iteration des routes
        foreach(($this->routerList['routes'] ?? []) as $key => $route){

            # Check route name
            $route['name'] = !isset($route['name']) || empty($route['name']) ?
                'route_' . $key :
                    $route['name'];

            # Convert route to array if string
            if (is_string($route['patterns']))
                $route['patterns'] = [$route['patterns']];

            # Check route and methods not empty
            if (empty($route['patterns']) || empty($route['methods']))
                continue;

            # Convert methods to array if string
            if (is_string($route['methods']))
                $route['methods'] = [$route['methods']];

            # Check if * in methods
            if (in_array('*', $route['methods']))
                $route['methods'] = $methods;

            # Filter methods by methods allowed
            $route['methods'] = array_filter(
                $route['methods'],
                function ($v) use ($methods) {
                    return in_array(strtoupper($v), $methods);
                }
            );
            
            # Get namespace
            $actionNameSpace = $this->_getActionNamespace($route);

            # Get action class name of the current route
            if($actionNameSpace)

                # Iteration des routes
                foreach($route['patterns'] as $pattern)

                    # Iteration des methods
                    foreach($route['methods'] as $method)

                        # Add Route in Router
                        $this->instance->addRoute(
                            $pattern,
                            $actionNameSpace
                        );

        }

    }

    /** Save router list in cache
     * @return void
     */
    private function _saveRoutersListInCache():void{

        # Set filename
        $filename = __ROOT_APP__.self::PATH_CACHE.date("YmdHis")."_cache.php";

        # Save new cache
        $this->instance->dumpOnDisk($filename);

    }

    /** Get action Namespace depending of route given
     * @param array $route
     */
    private function _getActionNamespace(array $route = []):string{

        # Set result
        $result = "";

        # Check required value in route
        if(isset($route['name']) && $route['name']){

            # Push namespace origin
            $result = "App\Controllers";

            # Check if folder
            if(isset($route['folder']))

                # Add name in result
                $result .= 
                    "\"".
                    trim(
                        ucfirst(
                            strtolower(
                                $route['folder']
                            )
                        ),
                        "\""
                    );
                ;

            # Push name of class
            $result .= 
                '\\'.
                trim(
                    Strings::snakeToCamel(
                        $route['name'],
                        true
                    ),
                    "\\"
                ).
                "Action"
            ;

        }

        # Check result exist
        /* if(!$result)
            $result = ""; */

        # Return result
        return $result;

    }
    
    /**********************************************************************************
    * Constant
    */

    # Path of the router cache
    public const PATH_CACHE = "/cache/routers/";

}