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
use Symfony\Component\HttpFoundation\Cookie;
use LuckyPHP\Http\Request;
use LuckyPHP\Code\Objects;
use App\Model;

/** Class Controller
 * 
 */
abstract class Controller{

    /****************************************************************
     * Hooks
     */

    /** Run Package
     * 
     */
    public function run(){

        # Read Push action
        $this->readPush();

    }

    /****************************************************************
     * Methods
     */
    
    /** Read Push
     * 
     */
    public function readPush(){

        # Read all methods
        $methods = Objects::get_class_methods($this);
        
        # Iteration des methods
        foreach($methods as $method):

            # Set prefix
            $method_prefix = substr($method->name, 0, 4);

            # Set name
            $method_name = substr($method->name, 4);

            # Check if name has push and push is allowed
            if($method_prefix == "push" && in_array($method_name, self::PUSH_ALLOWED))

                # Ingest push
                $this->_ingestPush($method_name);

        endforeach;
                

    }

    /****************************************************************
     * Methods extra
     */
    
    /** Ingest push
     * 
     */
    private function _ingestPush(string $method_name = ""){

        # Set result
        $result = $this->{$method_name}();

    }

    /****************************************************************
     * Constants
     */

    /** List of push methods allowed
     * 
     */
    private const PUSH_ALLOWED = ["Records", "Context", "Cookies", "Config", "UserInterface", "Errors", "File"];


}
