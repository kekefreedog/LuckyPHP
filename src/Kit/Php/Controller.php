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


/** Class of the controller
 * 
 */
class Controller{

    /** Constructor
     * 
     */
    public function __construct($config = [], $cache = []){

        # Set Request
        $this->request = [];

        # Set Controller
        $this->reponse = [];

    } 

}