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

    /** Construct
     * 
     */
    function __construct(){

        # Welcome message
        $this->message_welcome();

        # Root to action
        $this->rooting();
        
    }

    /** Welcome message
     * 
     */
    public function message_welcome(){

        # Welcome message
        echo
            "       __            __        ___  __ _____       ".PHP_EOL,
            "      / /  __ ______/ /____ __/ _ \/ // / _ \      ".PHP_EOL,
            "     / /__/ // / __/  '_/ // / ___/ _  / ___/      ".PHP_EOL,
            "    /____/\_,_/\__/_/\_\\_,  /_/  /_//_/_/          ".PHP_EOL,
            "                       /___/                       ".PHP_EOL,
            PHP_EOL,
            "👋 Welcome to LuckyPHP, my own development toolkit".PHP_EOL,
            "for developed beautiful web applications.".PHP_EOL,
            PHP_EOL
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
            echo
                "(❌)------------------------------------------------".PHP_EOL,
                "Sorry, no action is associated to the current file :".PHP_EOL,
                "   \"".$this->filename."\"".PHP_EOL,
                "-------------------------------------------------(❌)".PHP_EOL
            ;

            # Exit
            exit;

        endif;

    }

    /** Setup action
     * 
     */
    private function setup(){

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

    /** Prohibited names
     * 
     */
    public const NAME_PROHIBITED = ['Server','src','luckyphp','kekefreedog','vendor','bin'];

}
# "Now I will prepare the architecture of your new projects"