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

/** Interface of exception
 * 
 * @source https://www.php.net/manual/en/language.exceptions.php
 * 
 */
interface InterfaceException{

    /** Protected methods inherited from Exception class
     * 
     */
    // Exception message
    public function getMessage();

    // User-defined Exception code
    public function getCode();
    // Source filename                
    public function getFile();
    // Source line
    public function getLine();
    // An array of the backtrace()
    public function getTrace();
    // Formated string of trace
    public function getTraceAsString();
   
    /** Overrideable methods inherited from Exception class
     * 
     */
    // formated string for display
    public function __toString();
    public function __construct($message = null, $code = 0);

}

/** Class for error
 * 
 * @source https://www.php.net/manual/en/language.exceptions.php
 * 
 */
class Exception extends \Exception implements InterfaceException{

    // Exception message
    protected $message = 'Unknown exception';

    // Unknown
    private $string;

    // User-defined exception code                       
    protected $code = 0;

    // Source filename of exception
    protected $file;

    // Source line of exception
    protected $line;

    // Unknown
    private $trace;

    /** Construct
     * 
     */
    public function __construct($message = null, $code = 0){

        // Check message
        if (!$message) {
            throw new $this('Unknown '.get_class($this));
        }

        // Construct parent
        parent::__construct($message, $code);

    }
   
    /** Convert to string
     * 
     */
    public function __toString(){

        // Retourne message
        return 
            get_class($this).
            " '{$this->message}' in {$this->file}({$this->line})\n".
            "{$this->getTraceAsString()}"
        ;

    }

}