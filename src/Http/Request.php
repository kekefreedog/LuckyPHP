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
namespace  LuckyPHP\Http;

/** Dependance
 * 
 */
use Symfony\Component\HttpFoundation\Request as RequestSymfony;

/** Class page
 * 
 * @dependance root 
 * 
 */
class Request{

    /** Constructor
     * 
     */
    public function __construct(){

        /* Get request and put in data */
        $this->data = RequestSymfony::createFromGlobals();
        
    }

}