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
            'folders'   =>  [
                # Config of your app
                'config'    =>  [
                ],
                # Public folder
                'html'  =>  [
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
                            'source'    =>  'resources/php/index.php',
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
                                'action'    =>  [
                                    'files'     => [
                                        'HomeAction.js' =>  [
                                            'source'    =>  'resources/js/action/HomeAction.js',
                                        ],
                                    ]
                                ],
                                'component'    =>  [
                                    'files'     => [
                                        'Header.js' =>  [
                                            'source'    =>  'resources/js/component/Header.js',
                                        ],
                                        'Search.js' =>  [
                                            'source'    =>  'resources/js/component/Search.js',
                                        ],
                                        'Sidenav.js' =>  [
                                            'source'    =>  'resources/js/component/Sidenav.js',
                                        ],
                                    ],
                                ],
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
                                'module'    =>  [],
                            ],
                            'files'     =>  [
                                'app.js'    =>  [
                                    'source'    =>  'resources/js/app.js',
                                ],
                                'css.js'    =>  [
                                    'source'    =>  'resources/js/css.js',
                                ],
                                'bundle.js'    =>  [
                                    'source'    =>  'resources/js/bundle.js',
                                ],
                            ]
                        ],
                        'json'      =>  [
                            'folders'   =>  [
                                'token'    =>  [
                                ]
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
                            'source'    =>  'resources/php/Kernel.php',
                        ],
                        'Model.php'         =>  [
                            'source'    =>  '/resources/php/Model.php',
                        ],
                        'Viewer.php'          =>  [
                            'source'    =>  'resources/php/Viewer.php',
                        ],
                        'Controller.php'    =>  [
                            'source'    =>  'resources/php/Controller.php',
                        ],
                        'App.php'           =>  [
                            'source'    =>  'resources/php/App.php',
                        ],
                    ],
                    'folders'   =>  [
                        'Controllers'   =>  [
                        ]
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
                '.gitignore'    =>  [
                    'source'        =>  'resources/etc/.gitignore',
                ],
                'webpack.prod.js' =>  [
                    'source'    =>  'resources/js/webpack/webpack.prod.js',
                ],
                'webpack.dev.js' =>  [
                    'source'    =>  'resources/js/webpack/webpack.dev.js',
                ],
            ]
        ],

    ];

}