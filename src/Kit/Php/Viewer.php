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
namespace App;


/** Class of the viewer
 * 
 */
class Viewer{

    /** Constructor
     * 
     */
    public function __construct($config = [], $cache = [], $request = [], $reponse = []){

        echo 
            "<!doctype html>".PHP_EOL.
            "<html>".PHP_EOL.
            "<head>".PHP_EOL.
            "    <title>Getting Started With Webpack</title>".PHP_EOL.
            "</head>".PHP_EOL.
            "<body>".PHP_EOL.
            "    <div class=\"row\">".PHP_EOL.
            "       <div class=\"col s12\">".PHP_EOL.
            "            <div class=\"card\">".PHP_EOL.
            "                <div class=\"card-content\">".PHP_EOL.
            "                    <p>Hello</p>".PHP_EOL.
            "                </div>".PHP_EOL.
            "            </div>".PHP_EOL.
            "        </div>".PHP_EOL.
            "    </div>".PHP_EOL.
            "    <script src=\"js/index.js\"></script>".PHP_EOL.
            "</body>".PHP_EOL.
            "</html>"
        ;

    } 

}