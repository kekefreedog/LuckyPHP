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
use LuckyPHP\Extra\Kmaterialize\Setup as KmaterializeSetup;
use LuckyPHP\Kit\Structure as StructureKit;
use LuckyPHP\Kit\Routes as RoutesKit;
use LuckyPHP\Kit\Config as ConfigKit;
use LuckyPHP\Kit\Media as MediaKit;
use LuckyPHP\Kit\Page as PageKit;
use Symfony\Component\Yaml\Yaml;
use LuckyPHP\File\Controller;
use LuckyPHP\File\Structure;
use LuckyPHP\Server\Config;
use LuckyPHP\Code\Arrays;
use LuckyPHP\Server\Cli;
use LuckyPHP\File\Files;
use LuckyPHP\Code\Forms;

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
    public function __construct($input, $directory = "/", $cliMessage = true){

        /** Define roots
         * 
         */
        Config::defineRoots([
            'app'       =>  $directory,
            'www'       =>  $directory.'www/',
            'luckyphp'  =>  $directory.'vendor/kekefreedog/luckyphp/',
        ]);
        if($cliMessage) Cli::success("Roots defined");

        /** Write Config > App 
         * 
         */
        $this->configSetup($input);
        if($cliMessage) Cli::success("Config ready");

        /** Structure Folders
         * 
         */
        $this->structureSetup();
        if($cliMessage) Cli::success("Folder structure created");

        /** Write Config > Routes
         * 
         */
        $this->routesWrite();
        if($cliMessage) Cli::success("Site routes defined");

        /** Check Controllers
         * 
         */
        $this->controllerCheck();
        if($cliMessage) Cli::success("Controller created");

        /** Page default information
         * 
         */
        $this->pageWrite();
        if($cliMessage) Cli::success("Page informations defined");

        /** Media default information
         * 
         */
        $this->mediaWrite();
        if($cliMessage) Cli::success("Media defined");

        /** Database setup
         * 
         */
        # $this->databaseSetup();
        # if($cliMessage) Cli::success("Database ready");

        /** Start command for install PHP dependancies with Composer
         * 
         */
        $this->composerUpdate();
        if($cliMessage) Cli::success("PHP dependancies installed");

        /** Start command for install JS dependancies with NPM
         * 
         */
        $this->npmUpdate();
        if($cliMessage) Cli::success("JS dependancies installed");

        /** Load Extra Assets
         * 
         */
        $this->extraAssetsLoad();
        if($cliMessage) Cli::success("Extra assets loaded");

        # Web Pack Builder
        $this->webpackBuilder();
        if($cliMessage) Cli::success("Assets compiled and minimized");

        # Final message
        if($cliMessage) Cli::flank("Your app is ready for action !", "✨");
        
        
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

        # Check config folder exists
        if(!is_dir(__ROOT_APP__.'config')) mkdir(__ROOT_APP__.'config', 0777, true);

        # Iteration de $this->default
        foreach(ConfigKit::CONFIG AS $content)

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

        # Write input in config > app.yml
        file_put_contents(__ROOT_APP__.'config/app.yml', "# Configuration of the app".PHP_EOL.Yaml::dump($this->input, 10));

    }

    /** Config Set
     * 
     */
    private function routesWrite(){

        # Write input in config > app.yml
        file_put_contents(__ROOT_APP__.'config/routes.yml', "# Rootes of the app".PHP_EOL.Yaml::dump(RoutesKit::DEFAULT, 10));

        # Check RoutesKit::DEFAULT routes
        if(!isset(RoutesKit::DEFAULT['routes']) || empty(RoutesKit::DEFAULT['routes']))
            return;

        # Iteration of routes
        // foreach(RoutesKit::DEFAULT['routes'] as $key => $route):

        //     # Check route name
        //     $route['name'] = !isset($route['name']) || empty($route['name']) ?
        //         'route_'.$key :
        //             $route['name'];

        //     # Write controller of the current route
        //     Files::controllerWrite($route);

        // endforeach;

    }

    /** Config Set
     * 
     */
    private function mediaWrite(){

        # Write input in config > app.yml
        file_put_contents(__ROOT_APP__.'config/media.yml', "# Media of the app".PHP_EOL.Yaml::dump(MediaKit::DEFAULT, 10));

        # Check RoutesKit::DEFAULT routes
        if(!isset(RoutesKit::DEFAULT['routes']) || empty(RoutesKit::DEFAULT['routes']))
            return;

    }

    /** Controller Creation
     * 
     */
    private function controllerCheck(){

        # Check and generated controller if needed
        new Controller();

    }

    /** Config Set
     * 
     */
    private function pageWrite(){

        # Write input in config > page.yml
        file_put_contents(__ROOT_APP__.'config/page.yml', "# Page of the app".PHP_EOL.Yaml::dump(PageKit::DEFAULT, 10));

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

        # Execute command
        shell_exec('composer update');

    }

    /** Update composer
     * 
     */
    private function npmUpdate(){

        # Execute command
        shell_exec('npm update');

    }

    /** Extra assets loader
     * 
     */
    private function extraAssetsLoad(){

        # Kmaterialize
        new KmaterializeSetup();

    }

    /** WebpackBuilder
     * 
     */
    private function webpackBuilder(){

        # Execute command
        shell_exec('npm run webpack-build');

    }

}