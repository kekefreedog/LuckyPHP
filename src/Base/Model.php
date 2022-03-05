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
use Symfony\Component\Finder\Finder;
use LuckyPHP\Server\Exception;
use LuckyPHP\Kit\StatusCodes;
use LuckyPHP\Server\Config;
use LuckyPHP\Http\Header;
use LuckyPHP\Code\Arrays;
use LuckyPHP\File\Json;
use PDO;

/** Class page
 * 
 */
class Model{

    /** Parameters
     * 
     */
    
    # Schema of the model
    private $schema = [];

    # Lock schema
    private $lock = false;

    # Data
    # @deprecated
    protected $data = [];

    # Config
    # @deprecated
    private $config = [];
    
    /****************************************************************
    * Constructor
    */
    public function __construct(){

        # Prepare schema
        $this->_prepareSchema();

    }
    
    /****************************************************************
    * Hooks
    */

    /** Run Model
     * - Run modal structure and return reponse
     * @return array
     */
    public function run():array{

        # Set result
        $result = $this->schema;

        # Return result
        return $result;

    }

    /** Lock model schema
     * @param bool|null $flag Value :
     *  - null : Return current lock status
     *  - true : Lock schema
     *  - false : Unlock schema
     * @return bool
     */
    public function lock(bool|null $flag = null):bool{

        # Check flag isn't null
        if($flag !== null)

            # Set lock
            $this->lock = $flag ? true : false;

        # Set result
        $result = $this->lock;

        # Return result
        return $result;

    }

    /****************************************************************
     * > Errors
     */

    /** Push Errors
     * Add errors in modal
     * @param array $errors
     *  - One error : [ "code" => 500, "type" => "warn", "detail" => "Oups..." ]
     *  - Multiple errors [ [ "detail" => "Oups..." ], [ "detail" => "Oups..." ] ]  
     * @param int $flag 
     *  - Determine if push _status_code parameters depending of the type of request
     *  - 0 : Auto
     *  - 1 : true
     *  - 2 : false
     * @param bool $exit_error Stop the script and return error
     * @return ModelBase
     */
    public function pushErrors(array $errors, int $flag = 0, bool $exit_error = false):Model{

        # Check lock
        if($this->lock()) return $this;

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
                $this->_pushError($errors, $statusCode);

            # If multiple
            else

                # Iteration des erreurs
                foreach($errors as $error)

                    # Push error
                    $this->_pushError($error, $statusCode);

        # Check if exit function
        if($exit_error)

            # Lock schema
            $this->lock(true);

        # Return Model
        return $this;

    }

    /** Get Errors
     * 
     * @return array
     */
    public function getErrors():array{

        # Return errors
        return $this->schema['errors'] ?? [];

    }

    /** Reset Errors
     * @return void
     */
    public function resetErrors():Model{

        # Check lock
        if($this->lock()) return $this;

        # Unset errors
        $this->schema['errors'] = [];

        # Return Model
        return $this;

    }

    /****************************************************************
     * Records
     */

    /** Pushs records
     * @param array $records Records to push in records
     * @param string|null $flag Option about records pushed :
     *  - null : Push all records
     *  - "single" : Push only one record
     * @return Model
     */
    public function pushRecords(array $records = [], string|null $flag = null):Model{

        # Check lock
        if($this->lock()) return $this;

        # Check flags
        if(!in_array($flag, [null, "single"]))

            # New exception
            throw new Exception("Flags in push records is not allowed !", 500);


        # Flag null
        if($flag == null)

            $this->schema['records'] = $records;
        
        # Single record
        elseif($flag == "single")

            $this->schema['records'][] = $records;

        # Return Model
        return $this;

    }

    /** Pushs records
     * @param string $records String for the query in bdd
     * @param PDO $database If empty take the dafault bdd
     * @return Model
     */
    public function pushRecordsQuery(string $sql_query = "", PDO $database):Model{

        # Check lock
        if($this->lock()) return $this;

        # Database class #

        # Return Model
        return $this;

    }

    /****************************************************************
     * > File
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

        # Check lock
        if($this->lock()) return $this;

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
        $this->schema = $result;

        # Return Model
        return $this;

    }

    /** Read File
     * Exemple of response :
     * [
     *      "path"  =>  "/img/toto.png"
     *      "header =>  [
     *          "Content-Type"  =>  "text/plain"
     *      ]
     * ]
     * @param string $path Path of the file
     * @return Model - Return first file found
     */
    public function readFile(string $path = ""):Model{

        # Check lock
        if($this->lock() || !$path) return $this;

        # Set result
        $result = [
            "path"  =>  null
        ];

        # Check path is external
        $external_url = (strpos("://", $path) !== false) ?
            true :
                false;

        # Set url
        $url = ($external_url ? "" : __ROOT_APP__).$path;

        # Check if url exist
        $file_exist = $external_url ? 
            Header::exist($url) : 
                is_file($url);

        # Check file exist
        if($file_exist):

            # Set schema
            $result['path'] = $url;

            # Set Content Type
            $result["header"]["Content-Type"] = mime_content_type($url);

        endif;

        # Replace schema by result
        $this->schema = $result;

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
        $this->schema = $result;

        # Return Model
        return $this;

    }

    /****************************************************************
     * > User Interface
     */

    /** set Framwork Extra
     * - Set extra data for some framwork
     * @return model
     */
    public function setFrameworkExtra():model{

        # Check lock
        if($this->lock()) return $this;

        # Load config app
        if(!isset($this->config['app']))
            $this->config = array_merge($this->config, Config::read("app"));

        # Check if isset app css framework package
        if(!isset($this->config['app']['css']['framework']['package']))
            return $this;

        # check if match with Kmaterialize
        if($this->config['app']['css']['framework']['package'] == "Kmaterialize"){

            # File to check
            $fileTocheck = __ROOT_APP__."resources/json/kmaterial.json";

            # Check dark mode
            $darkmode = 
                isset($this->config['app']['darkmode']['cookie']['mode']) ?
                    ($_COOKIE[$this->config['app']['darkmode']['cookie']['mode']] ?? false ):
                        false;

            # Check if theme set and folder associate exists
            if(file_exists($fileTocheck)){

                # Open json file
                $content = Json::open($fileTocheck);

                # Check content to push
                if(isset($content['template']) && !empty($content['template'])){

                    # Check darkmode
                    if($darkmode && in_array($darkmode, $this->config['app']['darkmode']['theme'] ?? []))

                        # Add theme in html
                        $content['template']['html']['attributes']['class'] ? 
                            $content['template']['html']['attributes']['class'] .= " $darkmode-theme" :
                                $content['template']['html']['attributes']['class'] = "$darkmode-theme";

                    # Open the file and push it on data _user_interface > framework
                    $this->schema['_user_interface']['framework'] = $content['template'];

                }

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

        # Check lock
        if($this->lock()) return $this;

        # Check if isset and not empty user interface
        if(!isset($this->data['_user_interface']))

            # Create _user_interface
            $this->data['_user_interface'] = [];

        # Check recursive
        $this->data['_user_interface'] = $recursive ? 
            array_merge_recursive($this->data['_user_interface'], $data) :
                array_merge($this->data['_user_interface'], $data);

        # Return Model
        return $this;

    }

    /** Push Action
     * @param string $type Type of action :
     *  - Update
     *  - Delete
     *  - Add
     * @param array|string $target Target of the action (css selector) 
     * @return model
     */
    public function pushAction(string $type = "update", array|string $target = "#main"):model{

        # Check lock
        if($this->lock()) return $this;

        # Check action and target
        if(!in_array(strtolower($type), ['update', 'delete', 'add']) || empty($target))

            # Set exception
            throw new Exception("Your action is not valid", 500);

        # Prepare target
        if(is_string($target))

            # Explode string by space
            $target = array_filter(explode(' ', $string));

        # Prepare result
        $result = [
            "type"      =>  $type,
            "target"    =>  $target
        ];

        # Push result in current data
        $this->schema['_user_interface']['action'][] = $result;

    }

    /****************************************************************
     * > Config
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
            if(isset($this->schema['_config'][$k]))

                # Merge
                $this->schema['_config'][$k] = array_merge_recursive($configs[$k], $this->schema['_config'][$k]);

            else

                # Push config
                $this->schema['_config'][$k] = $v;

        # Return Model
        return $this;

    }

    ###########
    ###########
    ###########
    ###########
    ###########

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

    /****************************************************************
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
    
    /****************************************************************
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

    /****************************************************************
     * Methods extra
     */

    /** Prepare Schema
     * 
     */
    private function _prepareSchema(){

        # Check context response
        if(__CONTEXT__['route']['response'] == "data")

            # Set response
            $response = self::SCHEMA_DATA;

        else

            # Set response
            $response = self::SCHEMA_BASIC;

        # Set schema
        $this->schema = $response;

    }

    /** Push error
     * @param array $error
     * @param bool $statusCode
     */
    private function _pushError(array $error, bool $statutCode):void{

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
        $this->schema['errors'][] = $result;

    }

    /****************************************************************
     * Constants
     */

    # Basic schema
    private const SCHEMA_BASIC = [
        "errors"            =>  [],
        "records"           =>  [],
        "_metadata"         =>  [],
        "_user_interface"   =>  [],
        "_config"           =>  [],
        "_cookies"          =>  [],
        "_context"          =>  [],
    ];

    # File schema
    private const SCHEMA_DATA = [
        "path"              =>  null,
        "header"=>  [
            "Content-Type"  =>  null
        ]
    ];

}
