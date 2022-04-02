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
use ReflectionClassConstant;
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

        # New model
        $this->newModel();

        # Read info
        $this->readDetails();

        # Read Push action
        $this->readPush();

        echo "<pre>";
        print_r($this->model->run());
        echo "</pre>";

    }

    /****************************************************************
     * Methods
     */

    /** New model
     * @param bool $force model to create new instance
     */
    public function newModel(bool $force = false){

        # Check model is not valid
        if( 
            (
                !isset($this->model) || 
                !$this->model
            ) ||
            $force
        )

            # New model instance
            $this->model = new Model();

    }

    /** Read info
     * 
     */
    private function readDetails(){

        # New reflection
        $reflection = new ReflectionClassConstant($this, "DETAILS");

        # Read constant
        $constant = constant($reflection->class."::".$reflection->name);

        # Check contant 
        if(!$constant)
            return;

        /**
         * Read info
         */

    }
    
    /** Read Push
     * 
     */
    private function readPush(){

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
     * @param string $method_name NAme of the method to call
     * @return void
     */
    private function _ingestPush(string $method_name = ""):void{

        # Set result
        $result = $this->{"Push$method_name"}();

        # Check result
        if(!empty($result))

            # Process data and check not false
            if(
                ($result = $this->_checkAndProcessPushData($result, $method_name)) !== false|null
            )

                # Push value in schema
                $this->model->ingest($result, strtolower($method_name));

    }

    /** Check And Process Push Data
     * @param string|array $data to check and process
     * @param string $entity Type of data to processed
     * @return string|array|bool|null
     */
    private function _checkAndProcessPushData(string|array $data = [], string $entity = ""):string|array|bool|null{

        # Set result
        $result = $data;

        # Return result@
        return $result;

    }

    /****************************************************************
     * Constants
     */

    /** List of push methods allowed
     * 
     */
    private const PUSH_ALLOWED = ["Records", "Errors", "File"];


}
