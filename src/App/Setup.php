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
use LuckyPHP\Code\Forms;
use LuckyPHP\Code\Arrays;
use LuckyPHP\File\Structure;
use LuckyPHP\Kit\Config;
use LuckyPHP\Kit\Structure AS StructureKit;
use Symfony\Component\Yaml\Yaml;

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
    public function __construct($input){

        # Structure Setup
        $this->structureSetup();

        # Set up config
        $this->configSetup($input);

        # Database Setup
        # $this->databaseSetup();
        
    }

    /** Structure Set
     * 
     */
    private function structureSetup(){

        # New structure
        $this->load['structure'] ?: new Structure();

        # Create folder structure
        $this->load['structure']->treeFolderGenerator(StructureKit::APP);


    }

    /** Config Set
     * 
     */
    private function configSetup($input = []){

        # New form
        $this->load['forms'] ?: new Forms;

        # Iteration de $this->default
        foreach (Config::CONFIG AS $content)

            # Set input
            $this->input[$content['name']] = 

                # Check value in input
                isset($input[$content['name']]) ?

                    # Process input
                    $this->load['forms']->process_input($input[$content['name']], $content) :

                        # Set default value
                        $content['default'];

        # Convert _ to multidimensional array
        $this->input = Arrays::stretch("_", $this->input);

        # Wrtie input in config > app.yml
        file_put_contents('/config/app.yml', Yaml::dump($this->input));

    }

    /** Database Set
     * 
     */
    private function databaseSetup(){

        

    }

}