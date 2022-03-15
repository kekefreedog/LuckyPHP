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
        'type'  =>  'html',
        # Page setting (will overwrite  default settings)
        'page'  =>  [
            'name'          =>  "/**|name|**/",
            'app_prefix'    =>  true,
            'description'   =>  "/**|description|**/",
            'favicon'       =>  null
        ],
        # Extra
        'extra' =>  [
            'context'           =>  true,
            'user_interface'    =>  true,
            'cookies'           =>  true,
            'config'            =>  [
                'black_list'        =>  []
            ],
        ]
    ];

    /****************************************************************
    * Layouts
    */
    const LAYOUTS = [
        'structure/head',
        'structure/sidenav',
        'page/home'
    ];

    /****************************************************************
    * Push helpers
    */

    /** Push records
     * 
     */
    public function pushRecords(){

        # Set result
        $result = [
            "entity"        =>  "message",
            "attributes"    =>  [
                'content'       =>  "Hello World !"
            ]
        ];

        # Return result
        return $result;

    }

    /****************************************************************
     * advanced
     * Way to create advanced action
     */
    private function advanced(){

        

    }

}