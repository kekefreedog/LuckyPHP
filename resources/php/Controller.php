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
namespace App;

/** Dependances
 * 
 */
use LuckyPHP\Base\Router;

/** Class of the controller
 * 
 */
class Controller{

    /** Constructor
     * 
     */
    public function __construct(){

        /** Router Init
         * 
         */
        $this->routerInit();

    } 

    /** Router Init
     *
     */
    private function routerInit(){

        # New router instance
        $this->router = new Router();

        # Run router
        $this->router->run();

    }

}