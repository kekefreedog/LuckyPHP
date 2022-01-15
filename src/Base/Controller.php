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
use Symfony\Component\HttpFoundation\Cookie;
use LuckyPHP\Http\Header;
use App\Model;
use JetBrains\PhpStorm\Internal\ReturnTypeContract;

/** Class Controller
 * 
 */
abstract class Controller{

    /** content parameters
     * 
     */
    public $content;

    /** Constructor
     * 
     */
    public function __construct(...$arguments){

        # Ingest arguments
        $this->argumentsIngest($arguments);
        
    }

    /** Ingest arguments
     * 
     */
    private function argumentsIngest($arguments){
        
        # Set request
        $this->requestPrepare($arguments[0] ?? null);

        # Set parameters
        $this->parametersPrepare([
            ...$arguments[1]
        ]);

        # Set route
        $this->routePrepare([
            'current' =>  $arguments[3] ?? null,
            ...$arguments[2] ?? []
        ]);

    }

    /** Prepare route
     * 
     */
    private function routePrepare($array){

        # Set route
        $this->route = [
            'current'   =>  [
                'pattern'   =>  $array['current'] ?? null,
                'method'    =>  $_SERVER['REQUEST_METHOD'] ?? null,
                'name'      =>  $array['name'] ?? null,
            ],
            'config'    =>  [
                'methods'   =>  $array['methods'] ?? [],
                'patterns'  =>  $array['patterns'] ?? [],
                'response'   =>  [
                    'default'       =>  $array['response'] ?? null,
                    'Content-Type'  =>  (!isset($array['response']) || $array['response'] === null) ?
                        null :
                            Header::getContentType($array['response'])
                ]
            ]
        ];

    }

    /** Prepare request
     * 
     */
    private function requestPrepare($obj){

        # Set route
        $this->request = $obj;

    }

    /** Prepare route
     * 
     */
    private function parametersPrepare($array){

        # Set route
        $this->parameters = $array;

    }

    /**
     *  Public action
     */

    # Set Get Route Pattern
    public function getRoutePattern():string{
        return $this->route['current']['pattern'] ?? "";
    }

    # Set Get Route Method
    public function getRouteMethod():string{
        return $this->route['current']['method'] ?? "";
    }

    # Set Get Route Method
    public function getRouteName():string{
        return $this->route['current']['name'] ?? "";
    }

    # Set Get All Method Allowed
    public function getRouteMethods():array{
        return $this->route['config']['methods'] ?? [];
    }

    # Set Get All Patterns Allowed for the current root
    public function getRoutePatterns():array{
        return $this->route['config']['patterns'] ?? [];
    }

    # Get Content
    public function getContent(){
        return $this->content;
    }

    # Get Content Type
    public function getResponseType():string{
        return $this->route['config']['response']['default'];
    }

    # Get Content Type
    public function getContentType():string{
        return $this->route['config']['response']['Content-Type'];
    }

    /**********************************************************************************
     * Model
     */

    # Parameters for model
    public $model;

    /** New Model
     * Create new model object
     * @return null
     */
    public function newModel():void{

        # Set model
        $this->model = new Model();

    }

    /** Get Model Result
     * @return array
     */
    public function getModelResult():array{

        # Return model result
        return (array)$this->model->execute();

    }

    /**********************************************************************************
     * Layouts (html constructor)
     */

    # Parameters for layouts
    private $layouts = [];
    
    /** Set Layouts to load
     * 
     */
    public function setLayouts(string|array $input = [], bool $merge = true):void{

        # Check input
        if(empty($input))
            return;

        # Convert input to array if not
        if(!is_array($input))
            $input = [$input];

        # Set layouts
        $this->layouts = $merge ?
            $this->layouts + $input :
                $input;

    }

    /** Get Layouts to load
     * @return array
     */
    public function getLayouts():array{

        # Return model result
        return (array)$this->layouts ?? [];

    }

    /**********************************************************************************
     * Data
     */

    # Data
    private $data = [];

    /** Set Data
     * @param any $data
     * @return void
     */
    public function setData($data):void{

        # Set data
        $this->data = $data;

    }

    /** Push Data
     * @param any $data
     * @param bool $recursive
     * @return void
     */
    public function pushData($data, bool $recursive = false):void{

        # Check recursive
        $recursive ?

            # Merge with recursive
            $this->data = array_merge_recursive(
                $this->data,
                $data
            ) : 
                
                # Merge
                $this->data = array_merge(
                    $this->data,
                    $data
                );

    }

    /** Push Data
     * @param string $name
     * @return array|bool|null|string
     */
    public function getData($name = "*"){

        # Check name
        if(!$name)
            return null;

        # Check if name is *
        if($name == "*")
            return $this->data;

        # Else check if key match to name
        return $this->data[$name] ?? null;
        

    }

    /**********************************************************************************
     * Cookie
     */

    # Cookie
    private $cookie = [];

    /** Set Cookie
     * @param string|array $input for cookie
     * @return void
     */
    public function setCookie(string|array $input = []):void{

        # Check name and value is set
        if(
            !isset($input['name']) ||
            !$input['name']
        )
            return;

        # Check input and set data
        $data = [
            "name"      =>  $input['name'],
            "value"     =>  $input['value'] ?? [],
            "domain"    =>  $input['domain'] ?? "fixstudio.wiki",
            "expires"   =>  $input['expires'] ?? strtotime('+ 1 year'),
            "secure"    =>  $input['secure'] ?? false,
        ];

        # Create cookie
        $cookie = Cookie::create($data['name'])
            ->withValue($data['value'])
            ->withExpires($data['expires'])
            ->withDomain($data['domain'])
            ->withSecure($data['secure'])
        ;

        # Push coolie to globam cookie
        $this->cookie[] = $cookie;


    }

    /** Get Cookie
     * @param string|array $input for cookie
     * @return array
     */
    public function getCookie(string|array $input = []):array{

        # Set result
        $result = [];

        # Check cookie
        if($this->cookie === null)
            return $result;

        # Check if input is *
        if($input == "*" || in_array("*", $input))
            return $this->cookie;

        # Convert input string to array
        if(is_string($input))
            $input = [$input];

        # Iteration des cookie
        foreach($this->cookie as $cookie)

            # Iteration input
            foreach($input as $current => $needle)

                # Check if name match
                if($cookie->getName() == $needle){

                    # Push cookie in result
                    $result[] = $cookie; 

                    # Remove current needle
                    unset($input[$current]);

                }

    }

    /** Remove Cookie
     * @param string|array $input for cookie
     * @return void
     */
    public function removeCookie(string|array $input = []):void{

        # Check cookie
        if($this->cookie === null || empty($input))
            return;

        # Convert input string to array
        if(is_string($input))
            $input = [$input];

        # Iteration des cookie
        foreach($this->cookie as $key => $cookie)

            # Iteration input
            foreach($input as $current => $needle)

                # Check if name match
                if($cookie->getName() == $needle)

                    # Remove cookie and needle
                    unset($this->cookie[$key], $input[$current]);

    }

    /** Clear cookie
     * @return void
     */
    public function clearCookie():void{

        # Set cookie null
        $this->cookie = null;

    }

}