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

/** Dependances
 * 
 */
use LuckyPHP\Interface\Exception as InterfaceException;

/** Class for error
 * 
 * @source https://www.php.net/manual/en/language.exceptions.php
 * 
 */
class Exception extends \Exception implements InterfaceException{

    // Exception message
    protected $message = 'Unknown exception';

    // User-defined exception code                       
    protected $code = 0;

    /** Construct
     * 
     */
    public function __construct($message = null, $code = 0){

        // Check message
        if (!$message)
            throw new $this('Unknown '.get_class($this));

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