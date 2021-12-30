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
 * This class required Google Material Icons & Font Awesome Icon
 * Color based on Google Color Chart
 * 
 */
class StatusCodes{

    /** Constant wich list all errors
     * 
     */
    const GET = [

        # 200

        # 300

        # 400
        
            # Request unauthorized
            401 =>  [
                "code"  =>  401,
                "title" =>  "Unauthorized",
                "style" =>  [
                    "color" =>  [
                        "text"  =>  "black",
                        "fill"  =>  "red"
                    ],
                    "icon"  =>  [
                        "class" =>  "material-icons",
                        "text"  =>  "block"
                    ]
                ]
            ],


        # 500

            # Internal Server Error 
            500 =>  [
                "code"  =>  500,
                "title" =>  "Internal Server Error",
                "style" =>  [
                    "color" =>  [
                        "text"  =>  "white",
                        "fill"  =>  "black"
                    ],
                    "icon"  =>  [
                        "class" =>  "material-icons",
                        "text"  =>  "error"
                    ]
                ]
            ],

            # Not Implemented on server
            501 =>  [
                "code"  =>  501,
                "title" =>  "Not Implemented",
                "style" =>  [
                    "color" =>  [
                        "text"  =>  "white",
                        "fill"  =>  "grey darken-1"
                    ],
                    "icon"  =>  [
                        "class" =>  "material-icons",
                        "text"  =>  "rule"
                    ]
                ]
            ],

        # 600

    ];

    /** Default
     * 
     */
    const DEFAULT = [
        "title" =>  "Error",
        "style" =>  [
            "color" =>  [
                "text"  =>  "white",
                "fill"  =>  "grey darken-1"
            ],
            "icon"  =>  [
                "class" =>  "material-icons",
                "text"  =>  "error"
            ]
        ]
    ];

}