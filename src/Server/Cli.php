<?php declare(strict_types=1);
/*******************************************************
 * Copyright (C) 2019-2021 Kévin Zarshenas
 * kevin.zarshenas@gmail.com
 * 
 * This file is part of Double Screen.
 * 
 * This code can not be copied and/or distributed without the express
 * permission of Kévin Zarshenas @kekefreedog
 *******************************************************/

/** Namespace
 * 
 */
namespace  Kutilities\Server;

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
            "👋 Welcome to LuckyPHP, my own development toolkit for".PHP_EOL,
            "developed beautiful web applications.".PHP_EOL,
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

        # Ask name
        while( 
            in_array(
                (
                    $this->data['name'] = 
                        trim(
                            readline('1. Name of your application : '.($nameSupposed ? '('.$nameSupposed.') ' : ''))
                        )
                    ),
                self::NAME_PROHIBITED
            )
        )
                    
            echo '"'.$this->data['name'].'" is not allowed ! ⚠️'.PHP_EOL;



        # Ask name
        while( 
            !in_array(
                (
                    $this->data['k_materialize'] = 
                        readline('2. Do you want use Kmaterialize ? [Yes] or [No] : ')
                    ),
                ['Yes', 'No']
            )
        )
                    
            echo '"'.$this->data['k_materialize'].'" is not valid ! ⚠️'.PHP_EOL;


    }

    /** Prohibited names
     * 
     */
    public const NAME_PROHIBITED = ['Server','src','luckyphp','kekefreedog','vendor','bin'];

}
# "Now I will prepare the architecture of your new projects"