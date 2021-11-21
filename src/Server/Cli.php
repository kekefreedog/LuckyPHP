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
            $this->{$this->filename};

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

        

    }

}
# "Now I will prepare the architecture of your new projects"