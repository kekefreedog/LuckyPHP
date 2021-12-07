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

/** Class Setup
 * 
 */
class Structure{

    /** Application structure
     * 
     * 
     */
    public const APP = [

        "/" =>  [
            'folders'=>  [
                # Public folder
                'www'   =>  [
                    'files'      =>  [
                        '.htaccess' =>  [
                            'source'    =>  null,
                            'function'  =>  [
                                'name'      =>  'htaccessWrite',
                                'arguments'=>  [
                                    true,
                                ],
                            ],
                        ],
                        'index.php' =>  [
                            'function'  =>  [
                                'name'      =>  'indexWrite'
                            ],
                        ]

                    ]

                ],
                # Ressources in css, js, hbs, md... or any other language
                'resources' =>  [
                    'folders'   =>  [
                        'css'       =>  [],
                        'js'        =>  [],
                        'hbs'       =>  [],
                        'md'        =>  [],
                    ],
                ],
                # Script that define your app
                'src' =>  [
                    'files'     =>  [
                        'Model.php'         =>  [],
                        'View'              =>  [],
                        'Controller.php'    =>  [],
                    ],
                    'folders'   =>  [
                        'Page'      =>  []
                    ],
                ],
                # Config of your app
                'config'    =>  [
                    'files'      =>  [
                        'app.yml' =>  [
                            'function'  =>  [
                                'name'      =>  'configWrite',
                            ],
                        ],
                    ]
                ],
                # Wiki of the app
                'wiki'      =>  [
                    'folders'=>  [
                        'app'       =>  [],
                        'api'       =>  [],
                        'src'       =>  [],
                    ],
                ],
                # Logs from the app and framework
                'logs'      =>  [
                    'folders'=>  [
                        'app.log'       =>  [],
                        'luckuphp.log'  =>  [],
                    ]
                ],
                # All media
                'storage'   =>  [

                ],
            ],
        ],

    ];

}