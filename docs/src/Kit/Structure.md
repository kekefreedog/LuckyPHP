# ***Class*** **Arrays**

## Info

```php
namespace  LuckyPHP\Kit\Structure;  # Name Space
public class Structure{}            # Class name
```

## Description
This class contains constant for structure folder

## Constants

### 1. public ***const*** **APP**
- Default structure of the app
```php
[
    "/" =>  [
        'folders'=>  [
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
                    ]

                ]

            ],
            # Ressources in css, js, hbs, md... or any other language
            'resources' =>  [
                'folders'   =>  [
                    'css'       =>  [
                        'files'   =>  [
                            'style.css' =>  [
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
                                            'name'      =>  'jsImportWrite',
                                            'arguments'=>  [
                                                "./../../../node_modules/Kmaterialize/dist/css/materialize-vd1-min.css"
                                            ],
                                        ],
                                    ],
                                    'components.js' =>  [
                                        'function'  =>  [
                                            'name'      =>  'jsImportWrite',
                                            'arguments'=>  [
                                                "./../../../node_modules/Kmaterialize/dist/css/materialize-vd2-min.css"
                                            ],
                                        ],
                                    ],
                                    'style.js' =>  [
                                        'function'  =>  [
                                            'name'      =>  'jsImportWrite',
                                            'arguments'=>  [
                                                "./../../css/style.css"
                                            ],
                                        ],
                                    ],
                                ]
                            ],
                        ],
                        'files'     =>  [
                            'app.js'         =>  [
                                'source'    =>  'src/Kit/Js/app.js',
                            ],
                        ]
                    ],
                    'hbs'       =>  [],
                    'md'        =>  [],
                ],
            ],
            # Script that define your app
            'src' =>  [
                'files'     =>  [
                    'Kernel.php'         =>  [
                        'source'    =>  'src/Kit/Php/Kernel.php',
                    ],
                    /* 'Model.php'         =>  [
                        'source'    =>  '/src/Kit/Php/Kernel.php',
                    ], */
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
            # Config of your app
            'config'    =>  [
                'files'      =>  [
                    # Settings of the app
                    'app.yml' =>  [
                        'function'  =>  [
                            'name'      =>  'configWrite',
                        ],
                    ],
                    # Routes of the app
                    'routes.yml' =>  [
                        'function'  =>  [
                            'name'      =>  'routesWrite',
                        ],
                    ],
                ]
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
```