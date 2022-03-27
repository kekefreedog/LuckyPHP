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

    /****************************************************************
     * Constants
     */

    /** All the default routes
     *      
     */
    public const DEFAULT = [

        /** Routes of the pages
         * 
         * Exemple :
         *      - name : '' Part of the title of the page
         *      - patterns : All the route patterns that redirect to the current page
         *      - methods : All methods allow for the current rout, methods allowed : GET, get, POST, post, PUT, put, DELETE, delete, OPTION, option, PATCH, patch, *
         *      - response : Type of response html / json ...
         */
        'routes'    =>  [

            /**
             * App
             */

            /* Index */
            [
                'name'      =>  'Home',
                'patterns'  =>  [
                    '/index/'
                ],
                'methods'   =>  [
                    'get',
                ],
                'response'   =>  'html'
            ],

            /**
             * Api
             */

            /* Info */
            [
                'name'      =>  'Info',
                'patterns'  =>  [
                    '/api/'
                ],
                'methods'   =>  [
                    'get'
                ],
                'response'   =>  'json'
            ],

            /**
             * All the others pages
             */

            /* Page not found */
            [
                'name'      =>  'Page not found',
                'patterns'  =>  [
                    '/*/'
                ],
                'methods'   =>  [
                    '*'
                ],
                'response'  =>  'html',
                'error'     => true,
            ],

            /**
             * All Favicon
             */

            /* Favicon */
            [
                'name'      =>  'Favicon',
                'patterns'  =>  [
                    '/_/favicon/[a:name]'
                ],
                'methods'   =>  [
                    'get'
                ],
                'response'   =>  'data'
            ],

        ],

        /** Methods allowed
         * 
         */
        'methods'   =>  [
            'GET', 'POST', 'PUT', 'DELETE', 'OPTION', 'PATCH'
        ]

    ];

}