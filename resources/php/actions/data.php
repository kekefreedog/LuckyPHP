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
namespace App\Controllers;

/** Dependances
 *
 */
use LuckyPHP\Interface\Controller as ControllerInterface;
use LuckyPHP\Base\Controller as ControllerBase;

/** Class for manage the workflow of the app
 *
 */
class /**|name|**/Action extends ControllerBase implements ControllerInterface{

    /****************************************************************
    * Details
    */
    const DETAILS = [
        # Type of response
        'type'              =>  'data',
        # Force Download
        'force_download'    =>  false,
    ];

    /****************************************************************
    * Push helpers
    */

    /** Push File
     * 
     */
    private function pushFile(){



    }

    /****************************************************************
     * advanced
     * Way to create advanced action
     */
    private function advanced(){

        

    }

}