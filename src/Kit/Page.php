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

use Attribute;

/** Class listing default pages
 * 
 * @source https://htmlhead.dev/
 */
class Page{

    /** Default page config
     * 
     */
    public const DEFAULT = [
        /* page */
        'page'  =>  [
            /* Head */
            'head'  =>  [
                /* Default */
                'default'   =>  'main',
                /* Branches of header */
                'branches'  =>  [
                    /* Main */
                    'main'  =>  [
                        /** <meta charset="utf-8">
                         *  - meta charset - defines the encoding of the website, utf-8 is the standard
                         */
                        [
                            'tag'       =>  'meta',
                            'attributes'=>  [
                                'charset'   =>  "{{app.charset}}",
                            ]
                        ],
                        /** <meta http-equiv="X-UA-Compatible" content="IE=edge">
                         * 
                         */
                        [
                            'tag'       =>  'meta',
                            'attributes'=>  [
                                'http-equiv'    =>  "X-UA-Compatible",
                                'content'       =>  "IE=edge",
                            ]
                        ],
                        /** <meta name="viewport" content="width=device-width, initial-scale=1">
                         *  - meta name="viewport" - viewport settings related to mobile responsiveness
                         *  - width=device-width - use the physical width of the device (great for mobile!)
                         *  - initial-scale=1 - the initial zoom, 1 means no zoom
                         */
                        [
                            'tag'       =>  'meta',
                            'attributes'=>  [
                                'name'   =>  "viewport",
                                'content'=> [
                                    'width'         =>  "device-width",
                                    'initial-scale' =>  1.0,
                                    'user-scalable' =>  0,
                                    'minimal-ui'    =>  null
                                ]
                            ]
                        ],
                        /** <meta http-equiv="Content-Security-Policy" content="default-src 'self'">
                         *  - Allows control over where resources are loaded from. 
                         *  - All content have to come from the same origin
                         */
                        /* [
                            'tag'       =>  'meta',
                            'attributes'=>  [
                                'http-equiv'    =>  'Content-Security-Policy',
                                'content'       =>  "default-src 'self'"
                                'content'       =>  "default-src 'self' '; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline' 'unsafe-eval';"
                            ]
                        ], */
                        /** <meta name="application-name" content="Application Name">
                         *  - Name of web application
                         */
                        [
                            'tag'       =>  'meta',
                            'attributes'=>  [
                                'name'      =>  'application-name',
                                'content'   =>  '{{app.name}}'
                            ]
                        ],
                        /** <meta name="theme-color" content="#2196f3">
                         *  - Theme Color for Chrome, Firefox OS and Opera
                         */
                        [
                            'tag'       =>  'meta',
                            'attributes'=>  [
                                'name'      =>  'theme-color',
                                'content'   =>  '#2196f3'
                            ]
                        ],
                        /** <meta name="msapplication-TileColor" content="#9f00a7">
                         *  - Theme Color for Microsoft App
                         */
                        [
                            'tag'       =>  'meta',
                            'attributes'=>  [
                                'name'      =>  'msapplication-TileColor',
                                'content'   =>  '#2196f3'
                            ]
                        ],
                        /** meta name="msapplication-config" content="/favicon/windows-xml">
                         *  - Theme Color for Microsoft App
                         */
                        [
                            'tag'       =>  'meta',
                            'attributes'=>  [
                                'name'      =>  'msapplication-config',
                                'content'   =>  '/favicon/windows-xml'
                            ]
                        ],
                        /** <meta name="description" content="A description of the page">
                         *  - Short description of the document (limit to 150 characters)
                         *  - This content *may* be used as a part of search engine results.
                         */
                        [
                            'tag'       =>  'meta',
                            'attributes'=>  [
                                'name'      =>  'description',
                                'content'   =>  '{{app.description}}'
                            ]
                        ],
                        /** <meta name="robots" content="index,follow">
                         *  - Control the behavior of search engine crawling and indexing 
                         *  - All Search Engines
                         */
                        [
                            'tag'       =>  'meta',
                            'attributes'=>  [
                                'name'      =>  'robots',
                                'content'   =>  '{{app.indexing}}'
                            ]
                        ],
                        /** <meta name="googlebot" content="index,follow">
                         *  - Control the behavior of search engine crawling and indexing 
                         *  - Google Specific
                         */
                        [
                            'tag'       =>  'meta',
                            'attributes'=>  [
                                'name'      =>  'googlebot',
                                'content'   =>  '{{app.indexing}}'
                            ]
                        ],
                        /** <meta name="google" content="notranslate">
                         *  - Tells Google not to provide a translation for this document
                         */
                        [
                            'tag'       =>  'meta',
                            'attributes'=>  [
                                'name'      =>  'google',
                                'content'   =>  'notranslate'
                            ],
                        ],
                        /** <meta name="rating" content="General">
                         *  - Gives a general age rating based on the document's content
                         */
                        [
                            'tag'       =>  'meta',
                            'attributes'=>  [
                                'name'      =>  'rating',
                                'content'   =>  'General'
                            ],
                        ],
                        /** <link rel="manifest" href="manifest.json">
                         *  - Links to a JSON file that specifies "installation" credentials for the web applications
                         */
                        [
                            'tag'       =>  'link',
                            'attributes'=>  [
                                'rel'       =>  'manifest',
                                'href'      =>  'manifest.json'
                            ],
                        ],
                        /** <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
                         *  Touch icon favicon
                         */
                        [
                            'tag'       =>  'link',
                            'attributes'=>  [
                                'rel'       =>  'apple-touch-icon',
                                'size'      =>  '180x180',
                                'href'      =>  '/favicon/apple-touch'
                            ],
                        ],
                        /** <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
                         *  Basic icon 32px
                         */
                        [
                            'tag'       =>  'link',
                            'attributes'=>  [
                                'rel'       =>  'icon',
                                'type'      =>  'image/png',
                                'size'      =>  '32x32',
                                'href'      =>  '/favicon/icon-32px'
                            ],
                        ],
                        /** <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
                         *  Basic icon 32px
                         */
                        [
                            'tag'       =>  'link',
                            'attributes'=>  [
                                'rel'       =>  'icon',
                                'type'      =>  'image/png',
                                'size'      =>  '16x16',
                                'href'      =>  '/favicon/icon-16px'
                            ],
                        ],
                        /** <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#2196f3">
                         *  Safari
                         */
                        [
                            'tag'       =>  'link',
                            'attributes'=>  [
                                'rel'       =>  'mask-icon',
                                'href'      =>  '/favicon/safari-svg',
                                'color'     =>  '#2196f3'
                            ],
                        ],
                        /** <link rel="shortcut icon" href="/favicon/favicon.ico">
                         *  Safari
                         */
                        [
                            'tag'       =>  'link',
                            'attributes'=>  [
                                'rel'       =>  'shortcut icon',
                                'href'      =>  '/favicon/icon-ico'
                            ],
                        ],
                    ]
                ]
            ]
        ]
    ];

}