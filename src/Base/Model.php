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

use LuckyPHP\Code\Arrays;
use Symfony\Component\Finder\Finder;
use LuckyPHP\Server\Exception;
use LuckyPHP\Kit\StatusCodes;
use LuckyPHP\Server\Config;
use LuckyPHP\File\Json;

/** Class page
 * 
 */
class Model{

    /** Parameters
     * 
     */

    # Data
    protected $data = [];

    # Config
    private $config = [];

    /**********************************************************************************
     * Data
     */

    /** Execute Model
     * - Return data
     * @return array
     */
    public function execute():array{

        # Return data
        return $this->data;

    }

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
     * @return Model
     */
    public function pushErrors(array $errors, int $flag = 0):Model{

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

        # Return Model
        return $this;

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
    public function resetErrors():Model{

        # Unset errors
        unset($this->data['errors']);

        # Return Model
        return $this;

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
    public function pushConfig(array $configs):Model{

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

        # Return Model
        return $this;

    }

    /** Load config
     *  - load application config by name
     * @param array|string $config
     *  - "App"
     *  - ["App", "Routes"]
     *  - * for load all config in Config::CONFIG_PATH
     * @return void
     * 
     */
    public function loadConfig(array|string $configs):Model{

        # Check configs
        if(empty($configs))
            return $this;

        # Declare result
        $results = [];

        # Check if configs is "*"
        if($configs == "*")
            $configs = Config::CONFIG_PATH;

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

        # Return Model
        return $this;
        

    }

    /** Get Config
     * 
     * @return array
     */
    public function getConfig():array{

        # Return config
        return $this->data['_config'] ?? [];

    }

    /**********************************************************************************
     * _context
     */

    /** Push info
     * @return model
     */
    public function pushContext():model{

        # Set result
        $result = defined("__CONTEXT__") ? 
            __CONTEXT__ :
                [];

        # Push result in global data
        $this->data['_context'] = $result;

        # Return Model
        return $this;

    }

    /**********************************************************************************
     * _user_interface
     */

    /** set Framwork Extra
     * - Set extra data for some framwork
     * @return model
     */
    public function setFrameworkExtra():model{
        

        # Load config app
        if(!isset($this->config['app']))
            $this->config = array_merge($this->config, Config::read("app"));

        # Check if isset app css framework package
        if(!isset($this->config['app']['css']['framework']['package']))
            return $this;

        # check if match with Kmaterialize
        if($this->config['app']['css']['framework']['package'] == "Kmaterialize"){

            # Theme to check
            $themeToCheck = $this->config['app']['css']['framework']['theme'] ?? "";

            # File to check
            $fileTocheck = __ROOT_APP__."node_modules/Kmaterialize/dist/css/$themeToCheck/kmaterial.json";

            # Check if theme set and folder associate exists
            if(
                $themeToCheck &&
                file_exists($fileTocheck)
            ){

                # Open json file
                $content = Json::open($fileTocheck);

                # Check content to push
                if(isset($content['template']) && !empty($content['template']))

                    # Open the file and push it on data _user_interface > framework
                    $this->data['_user_interface']['framework'] = $content['template'];

            }

        }

        # Return Model
        return $this;

    }

    /** Push data in _user_interface
     * @param array $data Data to push in use interface
     * @param bool $recursive Merge recursively ?
     * @return model
     */
    public function pushDataInUserInterface(array $data = [], bool $recursive = false):model{

        # Chec if isset and not empty user interface
        if(isset($this->data['_user_interface']) && !empty($this->data['_user_interface']))

            # Check recursive
            $this->data['_user_interface'] = $recursive ? 
                array_merge_recursive($this->data['_user_interface'], $data) :
                    array_merge($this->data['_user_interface'], $data);

        # Return Model
        return $this;

    }
    
    /**********************************************************************************
    * cookie
    */

    /** Push Cookies
     * @param bool $expand Alloew to exepend cookie when they have "_"
     * @return model
     */
    public function pushCookies(bool $expand = false):model{

        # Declare Result
        $result = [];

        # Check cookies
        if(!empty($_COOKIE))
            $result = 
                $expand ?
                    Arrays::stretch($_COOKIE) :
                        $_COOKIE;

        # Push result in global data
        $this->data['_cookies'] = $result;

        # Return Model
        return $this;

    }

    /**********************************************************************************
     * file (data)
     */

    /** Get File
     * @param string $name Name of the file your are looking for
     * @param string $path Path of the file
     * @param array $ext Extensions of the file
     * @param bool $recursive Determine if finder search in subfolder
     * @return Model Return first file it finds
     *  - path
     *  - header
     *      - Content-Type : "text/plain"
     */
    public function getFile(string $name = "", string $path = "", array $ext = [], bool $recursive = true):Model{

        # Check $name
        if(!$name)

            # Set exception
            throw new Exception("If you want get file for data response, you have to indicate its name !", 500);

        # Declare filename
        $filename = [];

        # Declare result
        $result = [
            "path"  =>  null,
            "header"=>  [
                "Content-Type"  =>  null
            ]
        ];

        # New finder
        $finder = new Finder();

        # Check $ext
        if(empty($ext))

            # Set filename
            $filename = $name;

        else

            # Iteration ext
            foreach ($ext as $extension)
                
                $filename[] = "$name.$extension";

        # Set up finder
        $finder->files()->name($filename);

        # Check path
        if($path){

            $finder->in($path);

            # Check recursive
            if(!$recursive)

                # Set no depth
                $finder->depth('== 0');

        }

        # Check if finder are result
        if(!$finder->hasResults())

            # Set exception
            throw new Exception("No file finds for the current request... Sorry", 404);

        # Get first file find
        foreach ($finder as $file){

            # Set file
            $file = $file;

            # Break
            break;

        }

        # Set response
        $result['path'] = $file->getRealPath();
        $result['header']['Content-Type'] = mime_content_type($result['path']);

        # Set data
        $this->data = $result;

        # Return Model
        return $this;

    }

    /** Push file content
     * @param string $path Path of the file
     * @param array $header custom data to push in header
     */
    function pushFile(string $path = "", array $header = []):Model{

        # check file exist
        if(!$path || !file_exists($path))

            # New error
            throw new Exception("No file named \"".end(explode("/", $path))."\" found", 404);

        # Declare result
        $result = [
            "path"  =>  null,
            "header"=>  [
                "Content-Type"  =>  null
            ]
        ];

        # Set response
        $result['path'] = $path;
        $result['header']['Content-Type'] = mime_content_type($path);

        # Push array header in result
        if(count($header))

            $result['header'] = $result['header'] + $header;

        # Set data
        $this->data = $result;

        # Return Model
        return $this;

    }

}