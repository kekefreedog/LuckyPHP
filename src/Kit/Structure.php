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
                # Config of your app
                'config'    =>  [
                    'files'      =>  [
                        # Settings of the app
                        'app.yml' =>  [],
                        # Routes of the app
                        'routes.yml' =>  [],
                        # Page of the app
                        'page.yml'  =>  []
                    ]
                ],
                # Public folder
                'www'   =>  [
                    'files'      =>  [
                        '.htaccess' =>  [
                            'function'  =>  [
                                'name'      =>  'htaccessWrite',
                                'arguments'=>  [
                                    true,
                                ],
                            ],
                        ],
                        'index.php' =>  [
                            'source'    =>  'src/Kit/Php/index.php',
                        ],
                        'manifest.json' =>  [],
                    ]
                ],
                # Ressources in css, js, hbs, md... or any other language
                'resources' =>  [
                    'folders'   =>  [
                        'scss'      =>  [
                            'files'   =>  [
                                'style.scss'=>  [
                                    'function'  =>  [
                                        'name'      =>  'header',
                                    ],
                                ],
                            ],
                        ],
                        'css'      =>  [
                            'files'   =>  [
                                'style.css'=>  [
                                    'function'  =>  [
                                        'name'      =>  'header',
                                    ],
                                ],
                            ],
                        ],
                        'js'        =>  [
                            'folders'   =>  [
                                'style'     =>  [
                                    'files'     => [
                                        'framework.js' =>  [
                                            'function'  =>  [
                                                'name'      =>  'jsImportFrameworkWrite',
                                            ],
                                        ],
                                        'style.js' =>  [
                                            'function'  =>  [
                                                'name'      =>  'jsImportWrite',
                                                'arguments'=>  [
                                                    [
                                                        "./../../css/style.css",
                                                        "./../../scss/style.scss",
                                                    ]
                                                ],
                                            ],
                                        ],
                                    ]
                                ],
                                'module'    =>  []
                            ],
                            'files'     =>  [
                                'app.js'    =>  [
                                    'source'    =>  'src/Kit/Js/app.js',
                                ],
                                'css.js'    =>  [
                                    'source'    =>  'src/Kit/Js/css.js',
                                ],
                                'bundle.js'    =>  [
                                    'source'    =>  'src/Kit/Js/bundle.js',
                                ],
                            ]
                        ],
                        'hbs'       =>  [
                            'folders'   =>  [
                                'miscellaneous' =>  [
                                    'files'       =>  [
                                        'error.hbs' =>  []
                                    ]
                                ]
                            ]
                        ],
                        'md'        =>  [],
                    ],
                ],
                # Script that define your app
                'src' =>  [
                    'files'     =>  [
                        'Kernel.php'         =>  [
                            'source'    =>  'src/Kit/Php/Kernel.php',
                        ],
                        'Model.php'         =>  [
                            'source'    =>  '/src/Kit/Php/Model.php',
                        ],
                        'Viewer.php'          =>  [
                            'source'    =>  'src/Kit/Php/Viewer.php',
                        ],
                        'Controller.php'    =>  [
                            'source'    =>  'src/Kit/Php/Controller.php',
                        ],
                        'App.php'           =>  [
                            'source'    =>  'src/Kit/Php/App.php',
                        ],
                    ],
                    'folders'   =>  [
                        'Controllers'   =>  []
                    ],
                ],
                # Documentation of the app
                'docs'      =>  [
                    'folders'=>  [
                        'app'       =>  [],
                        'api'       =>  [],
                        'src'       =>  [],
                    ],
                ],
                # Logs from the app and framework
                'logs'      =>  [
                    'files'=>  [
                        'app.log'       =>  [
                        ],
                        'luckyphp.log'  =>  [
                        ],
                        'vendor.log'  =>  [
                        ],
                    ]
                ],
                # All media
                'storage'   =>  [

                ],
            ],
            # Update composer
            'files' =>  [
                'composer.json' =>  [
                    'function'      => [
                        'name'          =>  'composerUpdate',
                    ]
                ],
                'package.json'  =>  [
                    'function'      => [
                        'name'          =>  'packageUpdate',
                    ]
                ], 
                'webpack.config.js' =>  [
                    'source'    =>  'src/Kit/Js/webpack.config.js',
                ],
            ]
        ],

    ];

}