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
namespace  LuckyPHP\Server;

/** Dependance
 * 
 */
use LuckyPHP\Http\Header;
use LuckyPHP\Code\Strings;
use LuckyPHP\Server\Exception;
use Symfony\Component\Yaml\Yaml;

/** Class page
 * 
 * @dependance root 
 * 
 */
class Config{

    /** Read config
     * 
     */
    public static function read($input = ""):array {


        # If input is a path
        if(
            strpos($input, '/') !== false && 
            strpos($input, '.') !== false
        ){

            # Set path
            $path = __ROOT_APP__.$input;

            
        }else
        # If input is the name of the config
        if($input && array_key_exists($input, self::CONFIG_PATH)){

            # Set path
            $path = __ROOT_APP__.self::CONFIG_PATH[$input];

        }else
        # Else error
        {

            # Set exception
            throw new Exception("You are trying to load an invalid config \"$input\"", 500);

        }

        # Check if file of the config exist
        if(!file_exists($path))
            
            # Set exception
            throw new Exception("The config you are trying to open doesn't exists \"$path\"", 500);

        # Parse the config
        return Yaml::parseFile($path);

    }

    /** Check if config exists
     * @param string $configName
     */
    public static function exists(string $configName = ""):bool{

        # Check if false
        if(
            !$configName ||
            !file_exists(__ROOT_APP__."config/$configName.yml")
        )
            return false;

        # Return true
        return true;

    }

    /** Define roots
     * 
     * Define root from array
     * exemple of input :
     * [
     *      'app'       =>  $directory,
     *      'www'       =>  $directory.'www/',
     *      'luckyphp'  =>  $directory.'vendor/kekefreedog/luckyphp/',
     * ]
     * 
     * @param array $roots
     * 
     */
    public static function defineRoots(array $roots = []):bool {

        # Check array
        if(empty($roots))
            return false;

        # Iteration root
        foreach($roots as $rootName => $rootValue)

            # Check root name and root value
            if($rootName && $rootValue)

                # Define root
                define('__ROOT_'.strtoupper($rootName).'__', $rootValue);

        # Return true;
        return true;

    }

    /** Define context
     * @param array $data Data to push in context
     * @param bool $merge Merge or replace current data in context
     * @param void
     */
    public static function defineContext(array $data = [], bool $merge = true):void {

        # Get current context or define it
        $ctx = defined("__CONTEXT__") ? __CONTEXT__ : [];

        # Check data
        if(!empty($data)){

            # Set ctx
            $ctx = $merge ?
                array_merge($ctx, $data) :
                    $data;

        }else{

            # Get config routes
            $rootes = Config::read("routes");

            # Get current route
            $currentRoute = strtok($_SERVER["REQUEST_URI"], '?');

            # Set context
            $ctx = [
                # Root
                "route"  =>  [
                    "current"   =>  $currentRoute,
                    "parents"   =>  Strings::decomposeRoute($currentRoute)
                ]
            ];

            # Set current pattern
            $current = ($ctx["route"]["current"] == "/") ?
                [$ctx["route"]["current"], "/index/"] :
                    [$ctx["route"]["current"]];

            # Get route
            $route = self::matchPatternRoute($current);

            # Check route
            if($route)

                # Merge route info in ctx
                $ctx['route'] = array_merge(
                    $ctx['route'], 
                    $route, 
                    [
                        "Content-Type" => (
                            isset($route['response']) &&
                            !empty($route['response'])
                        ) ? 
                            Header::getContentType($route['response']) :
                                null
                    ]
                );

        }

        # Set globale context
        define("__CONTEXT__", $ctx);

    }

    /** Match Pattern Route
     * Return route info from the current route pattern given
     * @param string|array $currentPattern
     * @param array $config
     * @return array|bool
     */
    public static function matchPatternRoute(string|array $currentPattern, $config = ""):array|bool{

        # Chec currentPattern
        if(empty($currentPattern))
            return false;

        # Check current pattern
        if(!is_array($currentPattern))
            $currentPattern = [$currentPattern];

        # Declare
        $result = false;
        $currentRouteExplode = [];
        $currentPatternExplode = [];

        # Iteration des current pattern
        foreach($currentPattern as $value){

            # currentPatternExplode
            $resultExplode = array_filter(explode("/", trim($value, "/")));

            # Check result not empty
            if(!empty($resultExplode))

                # Push result in current pattern explode
                $currentPatternsExplode[] = $resultExplode;

        }
        
        # Check config
        if(empty($config))

            # Set config
            $config = self::read("routes")['routes'];

        # Iteration des routes
        foreach($config as $keyRoutes => $routes)

            # Check has patterns
            if(!empty($routes["patterns"]))

                # Iteration des patterns
                foreach($routes["patterns"] as $pattern){

                    # explode pattern
                    $currentRouteExplode = explode("/", trim($pattern, "/"));

                    # Iteration de $currentPatternsExplode
                    foreach ($currentPatternsExplode as $currentPatternExplode){

                        # Comparaison of count between currentRouteExplode and currentPatternExplode
                        if(count($currentPatternExplode) !== count($currentRouteExplode))
                            continue;

                        # Set vResponse
                        $vResponse = true;

                        # Iteration currentPatternExplode
                        foreach ($currentPatternExplode as $kCurrent => $v)

                            # Check if same value
                            if($v = $currentRouteExplode[$kCurrent])

                                # Success
                                continue;

                            # Check if brack
                            elseif(
                                substr($currentRouteExplode[$kCurrent], 1) == "[" && 
                                substr($currentRouteExplode[$kCurrent], -1) == "]"
                            ){

                                # Success continue
                                continue;

                            }else{

                                # Fail
                                $vResponse = false;

                                # Break
                                break;

                            }

                        # Check vResponse
                        if($vResponse){

                            # Set result
                            $result = $config[$keyRoutes];

                            # Break foreach
                            break(3);

                        }
                    
                    }

                }

        # Return result
        return $result;

    }

    /** Default file config
     * 
     */
    public const CONFIG_PATH = [
        'app'   =>  'config/app.yml',
        'routes'=>  'config/routes.yml',
        'page'  =>  'config/page.yml'
    ];

}