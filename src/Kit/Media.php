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

/** Class listing default medias
 * 
 */
class Media{

    /** Default page config
     * 
     */
    public const DEFAULT = [
        "media" =>  [
            "logo"  =>  [
                "main"  =>  [
                    "100px" =>  "/vendor/kekefreedog/luckyphp/resources/png/Logo/LuckyPHP-100px.png",
                    "500px" =>  "/vendor/kekefreedog/luckyphp/resources/png/Logo/LuckyPHP-500px.png",
                    "2000px"=>  "/vendor/kekefreedog/luckyphp/resources/png/Logo/LuckyPHP-2000px.png"
                ]
            ],
            /**
             * Favicon generated with https://realfavicongenerator.net/
             */
            "favicon"=> [
                "icon"      =>  [
                    "16px"      =>  "/vendor/kekefreedog/luckyphp/resources/favicon/favicon-16x16.png",
                    "32px"      =>  "/vendor/kekefreedog/luckyphp/resources/favicon/favicon-32x32.png",
                    "ico"      =>  "/vendor/kekefreedog/luckyphp/resources/favicon/favicon.ico",
                ],
                "android"   =>  [
                    "192px"     =>  "/vendor/kekefreedog/luckyphp/resources/favicon/android-chrome-192x192.png",
                    "512px"       =>  "/vendor/kekefreedog/luckyphp/resources/favicon/android-chrome-512x512.png",
                ],
                "apple"     =>  [
                    "57px"      =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-57x57.png",
                    "60px"      =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-60x60.png",
                    "72px"      =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-72x72.png",
                    "76px"      =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-76x76.png",
                    "114px"     =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-114x114.png",
                    "120px"     =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-120x120.png",
                    "144px"     =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-144x144.png",
                    "152px"     =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-152x152.png",
                    "180px"     =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-180x180.png",
                    "touch"     =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon.png",
                ],
                "applePrecomposed"     =>  [
                    "57px"      =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-57x57-precomposed.png",
                    "60px"      =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-60x60-precomposed.png",
                    "72px"      =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-72x72-precomposed.png",
                    "76px"      =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-76x76-precomposed.png",
                    "114px"     =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-114x114-precomposed.png",
                    "120px"     =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-120x120-precomposed.png",
                    "144px"     =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-144x144-precomposed.png",
                    "152px"     =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-152x152-precomposed.png",
                    "180px"     =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-180x180-precomposed.png",
                    "touch"     =>  "/vendor/kekefreedog/luckyphp/resources/favicon/apple-touch-icon-precomposed.png",
                ],
                "windows"   =>  [
                    "xml"       =>  "/vendor/kekefreedog/luckyphp/resources/favicon/browserconfig.xml",
                    "png"       =>  "/vendor/kekefreedog/luckyphp/resources/favicon/mstile-150x150.png",
                ],
                "safari"    =>  [
                    "svg"       =>  "/vendor/kekefreedog/luckyphp/resources/favicon/safari-pinned-tab.svg"
                ]
            ]
        ]
    ];

}