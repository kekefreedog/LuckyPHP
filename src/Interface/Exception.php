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
namespace  LuckyPHP\Interface;

/** Interface of exception
 * 
 * @source https://www.php.net/manual/en/language.exceptions.php
 * 
 */
interface Exception{

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