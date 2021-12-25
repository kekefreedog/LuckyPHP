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
namespace  LuckyPHP\App;

/** Use other library
 * 
 */
use LuckyPHP\File\Files;
use LuckyPHP\Code\Forms;
use LuckyPHP\Code\Arrays;
use LuckyPHP\Server\Config;
use LuckyPHP\File\Structure;
use Symfony\Component\Yaml\Yaml;
use LuckyPHP\Kit\Config as ConfigKit;
use LuckyPHP\Kit\Structure as StructureKit;
use LuckyPHP\Kit\Routes as RoutesKit;

/** Class Setup
 * 
 */
class Setup{

    /** Input value
     * 
     */
    private $input = [];

    /** Load module
     * 
     */
    private $load = [];

    /** Construct
     * 
     * 
     * @param array $input input for create app
     */
    public function __construct($input, $directory = "/"){

        # Define roots
        Config::defineRoots([
            'app'       =>  $directory,
            'www'       =>  $directory.'www/',
            'luckyphp'  =>  $directory.'vendor/kekefreedog/luckyphp/',
        ]);

        # Structure Setup
        $this->structureSetup();

        # Set up config
        $this->configSetup($input);

        # Write routes
        $this->routesWrite();

        # Database Setup
        # $this->databaseSetup();

        # Composer Update
        $this->composerUpdate();

        # Npm Update
        $this->npmUpdate();

        # Web Pack Builder
        $this->webpackBuilder();

        # App Ready
        $this->appReady();
        
    }

    /** Structure Set
     * 
     */
    private function structureSetup(){

        # New structure
        $this->load['structure'] = new Structure();

        # Create folder structure
        $this->load['structure']->treeFolderGenerator(StructureKit::APP, __ROOT_APP__);

    }

    /** Config Set
     * 
     */
    private function configSetup($input = []){

        # Iteration de $this->default
        foreach (ConfigKit::CONFIG AS $content)

            # Set input
            $this->input[$content['name']] = 

                # Check value in input
                isset($input[$content['name']]) ?

                    # Process input
                    Forms::process_input($input[$content['name']], $content)['value'] :

                        # Set default value
                        $content['default'] ?? null;

        # Convert _ to multidimensional array
        $this->input = Arrays::stretch($this->input, "_");

        # Wrtie input in config > app.yml
        file_put_contents(__ROOT_APP__.'config/app.yml', "# Configuration of the app".PHP_EOL.Yaml::dump($this->input, 10));

    }

    /** Config Set
     * 
     */
    private function routesWrite(){

        # Wrtie input in config > app.yml
        file_put_contents(__ROOT_APP__.'config/routes.yml', "# Rootes of the app".PHP_EOL.Yaml::dump(RoutesKit::DEFAULT, 10));

        # Check RoutesKit::DEFAULT routes
        if(!isset(RoutesKit::DEFAULT['routes']) || empty(RoutesKit::DEFAULT['routes']))
            return;

        # Iteration of routes
        foreach(RoutesKit::DEFAULT['routes'] as $key => $route):

            # Check route name
            $route['name'] = !isset($route['name']) || empty($route['name']) ?
                'route_'.$key :
                    $route['name'];

            Files::controllerWrite($route);

        endforeach;

    }

    /** Database Set
     * 
     */
    private function databaseSetup(){

        

    }

    /** Update composer
     * 
     */
    private function composerUpdate(){

        # Update composer
        echo 
            PHP_EOL.
            '(📦 )-[ UPDATING COMPOSER ]--------------------------'.
            PHP_EOL
        ;
        shell_exec('composer update');
        echo 
            "------------------------------------------------(✔️ )".
            PHP_EOL
        ;

    }

    /** Update composer
     * 
     */
    private function npmUpdate(){

        # Update composer
        echo 
            PHP_EOL.
            '(📦 )-[ UPDATING NPM ]-------------------------------'.
            PHP_EOL
        ;
        shell_exec('npm update');
        echo 
            "------------------------------------------------(✔️ )".
            PHP_EOL
        ;

    }

    /** WebpackBuilder
     * 
     */
    private function webpackBuilder(){

        # Update composer
        echo 
            PHP_EOL.
            '(📦 )-[ BULDING PACKAGE WITH WEBPACK ]----------------'.
            PHP_EOL
        ;
        shell_exec('npm run webpack-build');
        echo 
            "------------------------------------------------(✔️ )".
            PHP_EOL
        ;

    }

    /** App ready
     * 
     */
    private function appReady(){
        
        # Display message
        echo 
            PHP_EOL.
            '✨  Your app is ready for action ! ✨'.
            PHP_EOL.
            PHP_EOL
        ;

    }

}