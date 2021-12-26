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
use LuckyPHP\Base\Viewer as ViewerBase;
use LuckyPHP\Interface\Viewer as ViewerInterface;

/** Class of the viewer
 * 
 */
class Viewer extends ViewerBase implements ViewerInterface {

    /** Constructor
     * 
     */
    public function __construct(...$arguments){

        /** Parent constructor
         * 
         */
        parent::__construct(...$arguments);

    } 

}