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
namespace  LuckyPHP\File;

/** Class Files
 * 
 */
class Files{

    /** .htaccess
     * 
     * Write the htaccess file on www folder
     * @param bool $overwrite
     * 
     */
    public function htaccessWrite($overwrite = false){

        # Set reponse
        $reponse =
            "# ******************************************************".PHP_EOL.
            "#  Copyright (C) 2019-2021 Kévin Zarshenas".PHP_EOL.
            "#  kevin.zarshenas@gmail.com".PHP_EOL.
            "#  ".PHP_EOL.
            "#  This file is part of LuckyPHP.".PHP_EOL.
            "#  ".PHP_EOL.
            "#  This code can not be copied and/or distributed without the express".PHP_EOL.
            "#  permission of Kévin Zarshenas @kekefreedog".PHP_EOL.
            "# ******************************************************".PHP_EOL.
            "# Enable rewrite".PHP_EOL.
            "RewriteEngine on".PHP_EOL.
            PHP_EOL.
            "# Convert subfolder to root get value and redirect to .index".PHP_EOL.
            "RewriteCond %{REQUEST_FILENAME} !-f".PHP_EOL.
            "RewriteCond %{REQUEST_FILENAME} !-d".PHP_EOL.
            "RewriteRule ^(.*)$ index.php?root=$1 [QSA,L]".PHP_EOL
        ;

        # Return reponse
        return $reponse;

    }

    /** config write
     * 
     */
    public function configWrite(){

        # Set reponse
        $reponse = "";

        # Return reponse
        return $reponse;

    }

    /** index.php
     * 
     * Write the index.php file on www folder
     * 
     */
    public function indexWrite(){

        # Set reponse
        $reponse =
            "<?php declare(strict_types=1);".PHP_EOL.
            "/*******************************************************".PHP_EOL.
            " * Copyright (C) 2019-2021 Kévin Zarshenas".PHP_EOL.
            " * kevin.zarshenas@gmail.com".PHP_EOL.
            " * ".PHP_EOL.
            " * This file is part of LuckyPHP.".PHP_EOL.
            " * ".PHP_EOL.
            " * This code can not be copied and/or distributed without the express".PHP_EOL.
            " * permission of Kévin Zarshenas @kekefreedog".PHP_EOL.
            " *******************************************************/".PHP_EOL.
            "# Autoload (composer)".PHP_EOL.
            "require_once '../vendor/autoload.php';".PHP_EOL.
            "# Load App Initialization".PHP_EOL.
            "use App\Init;".PHP_EOL.
            "# New App Initialization ".PHP_EOL.
            "new Init();".PHP_EOL
        ;

        # Return reponse
        return $reponse;

    }

    /** Update composer.json
     * 
     */
    public function composerUpdate($filepath){

        // Check composer.json exist
        if(is_file($filepath)){

            // Get raw data
            $raw = file_get_contents($filepath);

            // Parse json
            $object = json_decode($raw, true);

        }else

            $object = [];

        /** Update object :
         * 
         *  "autoload": {
         *      "psr-4": {
         *          "App\\": [
         *              "src/"
         *          ]
         *      }
         *  }
         * 
         */
        $object["autoload"]["psr-4"]["App\\"] = ["src/"];

        // Check if update change anything
        if(json_encode($object) === $raw)
            return $raw;

        // Return object
        return json_encode($object, JSON_PRETTY_PRINT);

    }

    /** Update package.json
     * 
     */
    public function packageUpdate($filepath){

        /** Info package
         * 
         */
        $source = "github";
        $author = "kekefreedog";
        $package = "Kmaterialize";
        $branch = "advanced";

        // Check composer.json exist
        if(is_file($filepath)){

            // Get raw data
            $raw = file_get_contents($filepath);

            // Parse json
            $object = json_decode($raw, true);

        }else

            $object = [];

        # Set default object
        /** Set dependency
         * 
         * Exemple :
         * {
         *      "dependencies": {
         *         "kmaterialize": "github:kekefreedog/Kmaterialize#advanced"
         *      }
         *  }
         * 
         */
        $object["dependencies"][$package] = ($source&&$branch?"$source:$author/":"").$package.($branch?"#$branch":"");

        # Return object
        return json_encode($object, JSON_PRETTY_PRINT);

    }

}