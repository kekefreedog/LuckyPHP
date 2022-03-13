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
        'type'              =>  'json',
    ];

    /****************************************************************
    * Push helpers
    */

    /** Push records
     * 
     */
    private function pushRecords(){



    }

    /** Push Context
     * 
     */
    private function pushContext(){



    }

    /** Push Cookies
     * 
     */
    private function pushCookies(){



    }

    /** Push Config
     * 
     */
    private function pushConfig(){



    }

    /** Push UserInterface
     * 
     */
    private function pushUserInterface(){



    }

    /** Push Errors
     * 
     */
    private function pushErrors(){



    }

    /****************************************************************
     * advanced
     * Way to create advanced action
     */
    private function advanced(){

        

    }

}