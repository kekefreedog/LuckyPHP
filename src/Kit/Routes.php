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
namespace  LuckyPHP\Kit;

/** Class listing default pages
 * 
 */
class Routes{

    /** All the default pages
     * 
     */
    public const DEFAULT = [

        /**
         * App
         */

        /* Index */
        [
            'name'      =>  'Home',
            'route'     =>  [
                '/index/'
            ],
            'methods'   =>  [
                'get',
            ],
        ],

        /**
         * Api
         */

        /* Info */
        [
            'name'      =>  'Info',
            'route'     =>  [
                '/api/'
            ],
            'methods'   =>  [
                'get'
            ]
        ],

        /**
         * All the others pages
         */

        /* Page not found */
        [
            'name'      =>  'Page not found',
            'route'     =>  [
                '/*/'
            ],
            'methods'   =>  [
                'get'
            ]
        ]

    ];

}