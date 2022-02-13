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

/** Dependancies
 * 
 */
use \LuckyPHP\Server\Config;
use \League\CLImate\CLImate;
use \LuckyPHP\App\Setup;

/** Class page
 * 
 * @dependance root 
 * 
 */
class Cli{

    /** Current filename
     * 
     */
    public $filename = null;

    /** Data
     * 
     */
    private $data = [];

    /** Result
     * 
     */
    private $result = [];

    /** Engine for CLI display
     * 
     */
    private $engine = null;

    /** Construct
     * 
     */
    function __construct(){

        # Cli engine init
        $this->engineInit();

        # Display logo
        $this->logo();

        # Root to action
        # Depending of the name of the file
        $this->rooting();
        
    }

    /** Initialize engine
     * Start CLI engine
     * @return void
     */
    private function engineInit(){

        # Check if engine is already set
        if($this->engine == null)

            # New CLImat
            /** New CLImat instance
             * @source https://climate.thephpleague.com/
             */
            $this->engine = new CLImate();

    }

    /** Execute inputs
     * @param array $inputs
     * @param array $result
     * @return void
     */
    private function execute(array $inputs = [], array &$result = []):void{

        # Check inputs not empty
        if(!empty($inputs))

            # Iteration des inputs
            foreach($inputs as $k => $input):
 
                /** 
                 * Check if parent
                 */
                if(isset($input['parent']) && !empty($input['parent']))

                    # check name is set
                    if(
                        isset($input['parent']['name']) &&
                        $input['parent']['name'] &&
                        isset($result[$input['parent']['name']])
                    )

                        # Check operatior
                        if(
                            $input['parent']['operator'] == "equal" &&
                            $result[$input['parent']['name']] !== $input['parent']['value'] ?? false
                        )

                            # Continue iteration and skip current input
                            continue;
 
                /** 
                 * Prepare input
                 */

                # Type input
                if($input['type'] == "input"){

                    # New input instance
                    $instance = $this->engine->input($input['label'] ?? "");

                    # Check accept
                    if(isset($input['accept'])):

                        # Set accept
                        $instance->accept($input['accept']);

                        # Set strict
                        $instance->strict();

                    endif;

                    # Check default
                    if(isset($input['default']) && $input['default'])

                        $instance->defaultTo($input['default']);

                    # check data name
                    if(isset($input['name']) && $input['name'])

                        # Prompt
                        $result[$input['name']] = $instance->prompt();

                }else
                # Type confirm
                if($input['type'] == "confirm"){

                    # New input instance
                    $instance = $this->engine->confirm($input['label'] ?? "");

                    # Yes Action
                    if($instance->confirmed() && is_callable($input['yes'] ?? false))
                        $input['yes']($result);

                    # No Action
                    if(!$instance->confirmed() && is_callable($input['no'] ?? false))
                        $input['no']($result);


                }else
                # Type radio
                if($input['type'] == "radio"){

                    # New input instance
                    $instance = $this->engine->radio(
                        $input['label']     ?? "",
                        $input['options']   ?? []
                    );

                    # check data name
                    if(isset($input['name']) && $input['name'])

                        # Prompt
                        $result[$input['name']] = $instance->prompt();

                }

            endforeach;

    }

    /** Display Logo
     * @return void
     */
    public function logo():void{

        # check engine
        if(!$this->engine)
            return;

        # Logo
        $this->engine
            ->br()
            ->lightBlue("       __            __        ___  __ _____       ")
            ->lightBlue("      / /  __ ______/ /____ __/ _ \/ // / _ \      ")
            ->out      ("     / /__/ // / __/  '_/ // / ___/ _  / ___/      ")
            ->lightBlue("    /____/\_,_/\__/_/\_\\_,  /_/  /_//_/_/         ")
            ->lightBlue("                       /___/                       ")
        ;

    }

    /** Welcome message
     * 
     */
    public function welcome(){

        # check engine
        if(!$this->engine)
            return;

        # Logo
        $this->engine
            ->br()
            ->br()
            ->backgroundLightBlue()->black("👋 Welcome to LuckyPHP, my own development toolkit")
            ->backgroundLightBlue()->black("for developed beautiful web applications.         ")
            ->br()
        ;

    }

    /** Rooting to good action
     * 
     */
    private function rooting(){

        # Get current filename
        $this->filename = basename($_SERVER['SCRIPT_FILENAME'], '.php');

        # Check if method exist
        if(method_exists($this, $this->filename)):

            # Start action
            $this->{$this->filename}();

        else:

            # Echo error
            $this->engine
                ->br()
                ->to('error')
                ->red("(❌)------------------------------------------------")
                ->red("Sorry, no action is associated to the current file :")
                ->tab()->red("\"".$this->filename."\"")
                ->red("-------------------------------------------------(❌)")
                ->br()
            ;

            # Exit
            exit;

        endif;

    }

    /** Setup action
     * 
     */
    private function setup(){

        # Diplay welcome message
        $this->welcome();

        # Title action
        echo 
            "(🚀)-[ SETUP ]--------------------------------------".PHP_EOL,
            "".PHP_EOL;
        ;

        # Set folders
        $folders = [];

        # Explode __file__
        foreach(['/', '//', '\'', '\\'] AS $value)

            # If current dir includes current value
            if(strpos(__DIR__, $value) !== false)

                # Explode folders
                $folders = explode($value, str_replace(self::NAME_PROHIBITED, "", __DIR__));

        # Clean empty values in folder
        $folders = array_filter($folders);

        # Get last name
        $nameSupposed = empty($folders) ? "" : array_pop($folders);

        # 1. Ask name
        while( 
            in_array(
                (
                    $this->data['app_name'] = 
                        trim(
                            readline('1. Name of your application : '.($nameSupposed ? '('.$nameSupposed.') ' : ''))
                        )
                    ),
                self::NAME_PROHIBITED
            )
        )
                    
            echo '"'.$this->data['app_name'].'" is not allowed ! ⚠️'.PHP_EOL;

        # Check $this->data['name']
        if(!$this->data['app_name'])

            # Set value
            $this->data['app_name'] = $nameSupposed ? $nameSupposed : 'LuckyApp';


        # 2-1. Ask if you want to use Kmaterialize
        while( 
            !in_array(
                (
                    $kmaterialize = 
                        readline('2-1. Do you want use Kmaterialize ? [Yes] or [No] : ')
                    ),
                ['Yes', 'No']
            )
        )
                    
            echo '"'.$kmaterialize.'" is not valid ! ⚠️'.PHP_EOL;

        # Check if users want use Kmaterialize
        if($kmaterialize == 'Yes'){

            # Set css framework
            $this->data['app_css_framework_source'] = "github";
            $this->data['app_css_framework_author'] = "kekefreedog";
            $this->data['app_css_framework_package'] = "Kmaterialize";

            # 2-2. Ask if user wants use Kmaterialize basic or advanced
            while( 
                !in_array(
                    (
                        $this->data['app_css_framework_branch'] = 
                            readline('2-2. Load Kmaterialize Basic [0] or Advanced [1] ? [0] or [1] : ')
                        ),
                    ['0', 0, '1', 1]
                )
            )
                        
                echo '"'.$this->data['app_css_framework_branch'].'" is not valid ! ⚠️'.PHP_EOL;

            # Set css framwork branch (depending of the precedent answer)
            $this->data['app_css_framework_branch'] = intval($this->data['app_css_framework_branch']) ? 
                'advanced' : 
                    'basic'; 

        }

        # Check if users want use Kmaterialize
        if($this->data['app_css_framework_branch'] == 'advanced'){

            # Theme possible
            $themes = [
                0   =>  'sample',
                1   =>  'vertical-dark-menu',
                2   =>  'vertical-gradient-menu',
                3   =>  'vertical-modern-menu',
                4   =>  'vertical-menu-nav-dark',
                5   =>  'horizontal-menu'
            ];

            # Echo message
            echo  '2-3. Which theme use ?'.PHP_EOL;

            # Iteration des themes
            foreach($themes as $keyTheme => $valueTheme)
                
                # Dsiplay choice
                echo "      - $valueTheme [$keyTheme]".PHP_EOL;

            # 2-2. Ask if user wants use Kmaterialize basic or advanced
            while( 
                !in_array(
                    (
                        $this->data['app_css_framework_theme'] = 
                            readline('[0], [1], [2], [3], [4] or [5] : ')
                        ),
                    ['0', 0, '1', 1, '2', 2, '3', 3, '4', 4, '5', 5]
                )
            )
                        
                echo '"'.$this->data['app_css_framework_theme'].'" is not valid ! ⚠️'.PHP_EOL;

            # Set css framwork branch (depending of the precedent answer)
            $this->data['app_css_framework_theme'] = $themes[$this->data['app_css_framework_theme']];

        }

        # 3. Ask if you want to use interal auth
        while( 
            !in_array(
                (
                    $this->data['auth_internal'] = 
                        readline('3. Use internal auth script ? [Yes] or [No] : ')
                    ),
                ['Yes', 'No']
            )
        )
                    
            echo '"'.$this->data['auth_internal'].'" is not valid ! ⚠️'.PHP_EOL;

        # Echo en
        echo 
            PHP_EOL,
            "------------------------------------------------(✔️ )".PHP_EOL,
            PHP_EOL,
            'We are ready to create "'.$this->data['app_name'].'"'.PHP_EOL
        ;

        # Ready to create 
        readline('Press [enter] key and let\'s go ! 🔥🔥🔥');

        # Script for setup the project
        new \LuckyPHP\App\Setup($this->data, __DIR__."/../../../../../");

    }
    
    /** Sandbox
     *  
     */
    public function sandbox(){

        # Welcome
        $this->welcome();

        # List of inputs
        $inputs = [
            # App Name
            [
                "name"      =>  "app_name",
                "label"     =>  "Name of your application ? [".Config::supposedNameGet()."]",
                "type"      =>  "input",
                "accept"    =>  function($response){
                    return(
                        in_array($response, Config::APP_NAME_PROHIBITED) ?
                            false :
                                true
                    );
                },
                "default"   => Config::APP_NAME_DEFAULT,
            ],
            # Framework css
            [
                "label"     =>  "Use Kmaterialize ?",
                "type"      =>  "confirm",
                "yes"       =>  function(array &$result){
                    $result['app_css_framework_source'] = "github";
                    $result['app_css_framework_author'] = "kekefreedog";
                    $result['app_css_framework_package'] = "Kmaterialize";
                    $result['app_css_framework_dev'] = true;
                }, 
                "no"        =>  function(array &$result){
                    $result['app_css_framework_source'] = "";
                    $result['app_css_framework_author'] = "";
                    $result['app_css_framework_package'] = "";
                }, 
            ],
            # Framework css branch
            [
                "name"      =>  "app_css_framework_branch",
                "label"     =>  "Which branch use ?",
                "type"      =>  "radio",
                "options"   =>  ['advanced', 'basic']
            ],
            # Framework css theme
            [
                "name"      =>  "app_css_framework_theme",
                "label"     =>  "Which theme use ?",
                "type"      =>  "radio",
                "options"   =>  [
                    'sample',
                    'vertical-dark-menu',
                    'vertical-gradient-menu',
                    'vertical-modern-menu',
                    'vertical-menu-nav-dark',
                    'horizontal-menu'
                ],
                "parent"    =>  [
                    "name"      =>  "app_css_framework_branch",
                    "operator"  =>  "equal",
                    "value"     =>  "advanced"
                ]
            ],
            # Framework Js
            [
                "label"     =>  "Load LuckyJS ? 🐶",
                "type"      =>  "confirm",
                "yes"       =>  function(array &$result){
                    $result['app_js_framework_source'] = "npm";
                    $result['app_js_framework_author'] = "kekefreedog";
                    $result['app_js_framework_package'] = "@kekefreedog/luckyjs";
                    $result['app_js_framework_dev'] = true;
                }, 
                "no"        =>  function(array &$result){
                    $result['app_js_framework_source'] = "";
                    $result['app_js_framework_author'] = "";
                    $result['app_js_framework_package'] = "";
                    $result['app_js_framework_dev'] = "";
                }, 
            ],
            # Ready
            [
                "label"     =>  'Press [enter] key and let\'s go ! 🔥🔥🔥',
                "type"      =>  "confirm",
                "no"        =>  function(){
                    exit();
                }, 
            ]

        ];

        # Execute inputs
        $this->execute($inputs, $this->result);

        # Now setup the project
        new Setup($this->result, __DIR__."/../../tests/sandbox");    

    }

    /**********************************************************************************
     * Cli commands
     */

    /** Display successful message
     * @param string $message Message to display
     * @param bool $icon Icon to display before message
     */
    public static function success(string $message = "", bool $icon = true){

        # Check message
        if(!$message && !$icon)
            return;
        
        # Set result
        $result = "";

        # Push icon
        if($icon)
            $result .= "🟢";

        # Push message
        if($message)
            $result ?
                $result .= " $message" :
                    $result = $message;

        # New instance
        $instance = new CLImate;

        # Display message
        $instance->green($result);


    }

    /** Display successful message
     * @param string $message Message to display
     * @param bool $icon Icon to display before message
     */
    public static function error(string $message = "", bool $icon = true){

        # Check message
        if(!$message && !$icon)
            return;
    
        # Set result
        $result;

        # Push icon
        if($icon)
            $result = "🔴";

        # Push message
        if($message)
            $result ?
                $result .= " $message" :
                    $result = $message;

        # New instance
        $instance = new CLImate;

        # Display message
        $instance->red($result);

    }

    /** Display successful message
     * @param string $message Message to display
     * @param bool $icon Icon to display before message
     */
    public static function warning(string $message = "", bool $icon = true){

        # Check message
        if(!$message && !$icon)
            return;
    
        # Set result
        $result;

        # Push icon
        if($icon)
            $result = "🟠";

        # Push message
        if($message)
            $result ?
                $result .= " $message" :
                    $result = $message;

        # New instance
        $instance = new CLImate;

        # Display message
        $instance->orange($result);

    }

    /**********************************************************************************
     * Constants
     */

    /** Prohibited names
     * 
     */
    public const NAME_PROHIBITED = ['Server','src','luckyphp','kekefreedog','vendor','bin'];


}