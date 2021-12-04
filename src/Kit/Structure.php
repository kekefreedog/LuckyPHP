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
                'www'   =>  [
                    'folders'   =>  [
                        'app'       =>  [

                        ],
                        'api'       =>  [

                        ],
                    ],
                    'files'      =>  [
                        /* '.htaccess' =>  [
                            'source'    =>  null,
                            'function'  =>  [
                                'name'      =>  'htaccessWrite',
                                'arguments'=>  [
                                    true,
                                ],
                            ],
                        ], */
                        'index.php' =>  [
                            'function'  =>  [
                                'name'      =>  'indexWrite'
                            ],
                        ]

                    ]

                ],
                'resources' =>  [
                    'folders'   =>  [
                        'css'       =>  [
                        ],
                        'js'        =>  [
                        ],
                        'hbs'       =>  [
                        ],
                        'md'        =>  [
                        ],
                    ],
                ],
                'config'    =>  [
                    'files'      =>  [
                        'app.yml' =>  [
                            'function'  =>  [
                                'name'      =>  'configWrite',
                            ],
                        ],
                    ]
                ],
                'logs'      =>  [

                ],
                'storage'   =>  [

                ],
            ],
        ],

    ];

}