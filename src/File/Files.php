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

/** Dependance
 * 
 */
use LuckyPHP\Base\Router;

/** Class Files
 * 
 */
class Files{

    /** Header
     * 
     * Using /** *//*
     */
    public static function header(){

        # Set result
        $result =
            "/*******************************************************".PHP_EOL.
            " * Copyright (C) 2019-2021 Kévin Zarshenas".PHP_EOL.
            " * kevin.zarshenas@gmail.com".PHP_EOL.
            " *".PHP_EOL.
            " * This file is part of LuckyPHP.".PHP_EOL.
            " *".PHP_EOL.
            " * This code can not be copied and/or distributed without the express".PHP_EOL.
            " * permission of Kévin Zarshenas @kekefreedog".PHP_EOL.
            " *******************************************************/".PHP_EOL
        ;

        # Return result
        return $result;

    }

    /** Header alt
     * 
     * Using #
     */
    public static function headerAlt(){

        # Set result
        $result = 
            "# ******************************************************".PHP_EOL.
            "#  Copyright (C) 2019-2021 Kévin Zarshenas".PHP_EOL.
            "#  kevin.zarshenas@gmail.com".PHP_EOL.
            "#  ".PHP_EOL.
            "#  This file is part of LuckyPHP.".PHP_EOL.
            "#  ".PHP_EOL.
            "#  This code can not be copied and/or distributed without the express".PHP_EOL.
            "#  permission of Kévin Zarshenas @kekefreedog".PHP_EOL.
            "# ******************************************************".PHP_EOL
        ;

        # Return result
        return $result;

    }

    /** .htaccess
     * 
     * Write the htaccess file on www folder
     * @param bool $overwrite
     * 
     */
    public function htaccessWrite(){

        # Set reponse
        $reponse =
            $this->headerAlt().
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
            $this->header().
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

        # Set dependency
        $object["dependencies"][$package] = ($source&&$branch?"$source:$author/":"").$package.($branch?"#$branch":"");

        # Set dev dependencies
        $object["devDependencies"]["css-loader"]="^6.5.1";
        $object["devDependencies"]["file-loader"]="^6.2.0";
        $object["devDependencies"]["remove-files-webpack-plugin"]="^1.5.0";
        $object["devDependencies"]["style-loader"]="^3.3.1";
        $object["devDependencies"]["url-loader"]="^4.1.1";
        $object["devDependencies"]["webpack"]="^5.65.0";
        $object["devDependencies"]["webpack-cli"]="^4.9.1";

        # Set scripts
        $object["scripts"]["webpack-dev"] = "webpack --mode development";
        $object["scripts"]["webpack-build"] = "webpack --mode production";
        $object["scripts"]["webpack-watch"] = "webpack --watch --mode=development";

        # Return object
        return json_encode($object, JSON_PRETTY_PRINT);

    }

    /** Js Import Write
     * 
     * Write simple js file with one import
     */
    public function jsImportWrite($filepath, $import){

        # Prepare result
        $result =
            $this->header().
            $import ? "import \"$import\";" : ""
        ;

        # Return result
        return $result;

    }

    /** Controller Write
     * 
     */
    public static function controllerWrite($route){

        # Get name of current route
        $name = ltrim(
            str_replace(
                ["App", "\\"],
                ["src", "/"],
                Router::routeCallbackCheck($route['name'], false)
            ),
            "/"
        ).".php";

        # Set className
        $className = explode('/', $name);
        $className = end($className);
        $className = ucfirst(str_replace(".php", "", $className));
;
        # Set content
        $content = 
            '<?php declare(strict_types=1);'.PHP_EOL.
            self::header().
            PHP_EOL.
            '/** Namespace'.PHP_EOL.
            ' *'.PHP_EOL.
            ' */'.PHP_EOL.
            'namespace App\Controllers;'.PHP_EOL.
            PHP_EOL.
            '/** Dependances'.PHP_EOL.
            ' *'.PHP_EOL.
            ' */'.PHP_EOL.
            'use LuckyPHP\Base\Controller as ControllerBase;'.PHP_EOL.
            'use LuckyPHP\Interface\Controller as ControllerInterface;'.PHP_EOL.
            PHP_EOL.
            '/** Class for manage the workflow of the app'.PHP_EOL.
            ' *'.PHP_EOL.
            ' */'.PHP_EOL.
            'class '.$className.' extends ControllerBase implements ControllerInterface{'.PHP_EOL.PHP_EOL.
            '    /** Constructor'.PHP_EOL.
            '     *'.PHP_EOL. 
            '     */'.PHP_EOL.
            '    public function __construct(...$arguments){'.PHP_EOL.PHP_EOL.
            '        # Parent constructor'.PHP_EOL.
            '        parent::__construct(...$arguments);'.PHP_EOL.PHP_EOL.
            '        # Set name'.PHP_EOL.
            '        $this->name="'.$className.'";'.PHP_EOL.PHP_EOL.
            '    }'.PHP_EOL.PHP_EOL.
            '    /** Response'.PHP_EOL.
            '     *'.PHP_EOL. 
            '     */'.PHP_EOL.
            '    public function response(){'.PHP_EOL.PHP_EOL.
            '        # Return reponse'.PHP_EOL.
            '        return $this->name;'.PHP_EOL.PHP_EOL.
            '    }'.PHP_EOL.
            '}'
        ;

        # Put content in server
        file_put_contents(__ROOT_APP__.$name, $content);

    }

}