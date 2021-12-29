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
use LuckyPHP\Server\Exception;
use LuckyPHP\Kit\StatusCodes;
use LuckyPHP\Server\Config;

/** Class page
 * 
 */
class Model{

    /** Parameters
     * 
     */

    # Data
    protected $data = [];

    /**********************************************************************************
     * Errors
     */

    /** Push Errors
     * @param array $errors
     *  - One error : [ "code" => 500, "type" => "warn", "detail" => "Oups..." ]
     *  - Multiple errors [ [ "detail" => "Oups..." ], [ "detail" => "Oups..." ] ]  
     * @param int $flag 
     *  - Determine if push _status_code parameters depending of the type of request
     *  - 0 : Auto
     *  - 1 : true
     *  - 2 : false
     * @return void
     */
    public function pushErrors(array $errors, int $flag = 0):void{

        # Check errors
        if(!is_array($errors))

            # Set exception
            throw new Exception("You can't push a \"".gettype($errors)."\" in errors arguments", 500);

        # Set statutcode
        if(!$flag)

            # Function Need to be create
            $statusCode = true;

        elseif($flag == 1)

            # Set true
            $statusCode = true;

        else

            # Set false
            $statusCode = false;

        # Check errors
        if(!empty($errors))

            # Check if one error
            if(!is_array($errors[0]))

                # Push error
                $this->pushError($errors, $statusCode);

            # If multiple
            else

                # Iteration des erreurs
                foreach($errors as $error)

                    # Push error
                    $this->pushError($error, $statusCode);


    }
    /** Push error
     * @param array $error
     * @param bool $statusCode
     */
    private function pushError(array $error, bool $statutCode):void{

        # Declare result
        $result = [];

        # Check status code and code
        if($statutCode && isset($error["code"]) && is_numeric($error["code"]))

            # Push statut code in result
            $result['_status_code'] = StatusCodes::GET[$error["code"]] ?? StatusCodes::DEFAULT;

        # Iteration parameters
        foreach(['code', 'type', 'detail'] as $parameter)

            # Chec parameters
            if(isset($error[$parameter]) && !empty($error[$parameter])) 
                
                # Push parameters
                $result[$parameter] = $error[$parameter];

        # Check result
        if(!empty($result))

            # Push in global data
            $this->data['errors'][] = $result;

    }

    /** Get Errors
     * 
     * @return array
     */
    public function getErrors():array{

        # Return errors
        return $this->data['errors'] ?? [];

    }

    /** Reset Errors
     * @return void
     */
    public function resetErrors():void{

        # Unset errors
        unset($this->data['errors']);

    }

    /**********************************************************************************
     * Config
     */

    /** Push confg
     * @param array $config
     *  - Push custom config
     *  - Keys on the root should be string
     * @return void
     */
    public function pushConfig(array $configs):void{

        # Check keys are note int
        foreach($configs as $k => $v)

            # Check if int
            if(is_numeric($k))

                # Remove current value
                unset($configs[$k]);

            else
            # Check if array already exists
            if(isset($this->data['_config'][$k]))

                # Merge
                $this->data['_config'][$k] = array_merge_recursive($configs[$k], $this->data['_config'][$k]);

            else

                # Push config
                $this->data['_config'][$k] = $v;

    }

    /** Load config
     *  - load application config by name
     * @param array|string $config
     *  - "App"
     *  - ["App", "Routes"]
     * @return void
     * 
     */
    public function loadConfig(array|string $configs):void{

        # Check configs
        if(empty($configs))
            return;

        # Declare result
        $results = [];

        # Convert configs in array
        if(!is_array($configs))
            $configs = [$configs];

        # Iteration des configs
        foreach($configs as $config)

            # Check config exists
            if(Config::exists($config))

                # Get value of config file
                $results[] = array_merge_recursive(Config::read($config), $results);
                
        # Check results
        if(!empty($results))

        # Check keys are note int
        foreach($results as $k => $v)

            # Check if array already exists
            if(isset($this->data['_config'][$k]))

                # Merge
                $this->data['_config'][$k] = array_merge_recursive($results[$k], $this->data['_config'][$k]);

            else

                # Push config
                $this->data['_config'][$k] = $v;
        

    }

    /** Get Config
     * 
     * @return array
     */
    public function getConfig():array{

        # Return config
        return $this->data['_config'] ?? [];

    }

}