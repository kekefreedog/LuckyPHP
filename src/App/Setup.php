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

    /** Default input
     * 
     */
    public $default_config = [
        # App
        [
            'name'      =>  'app_name',
            'type'      =>  'VARCHAR',
            'default'   =>  'LuckyApp',
        ],
        [
            'name'      =>  'app_description',
            'type'      =>  'VARCHAR',
            'default'   =>  '',
        ],
        [
            'name'      =>  'app_website',
            'type'      =>  'VARCHAR',
            'process'   =>  'url',
            'default'   =>  '',
        ],
        [
            'name'      =>  'app_website_alt',
            'type'      =>  'VARCHAR',
            'process'   =>  'url',
            'default'   =>  '',
        ],
        [
            'name'      =>  'app_admin_email',
            'type'      =>  'VARCHAR',
            'process'   =>  'email',
            'default'   =>  '',
        ],
        # Css
        [
            'name'      =>  'css_framework',
            'type'      =>  'VARCHAR',
            'admit'     =>  ['Kmaterialize'],
            'default'   =>  'Kmaterialize',
        ],
        # Auth
        [
            'name'      =>  'php_auth',
            'type'      =>  'VARCHAR',
            'admit'     =>  ['Kauth'],
            'default'   =>  'Kauth',
        ],
    ];

    /** Construct
     * 
     * 
     * @param array $input input for create app
     */
    public function __construct($input){

        # New form
        $this->load['forms'] ?: new Forms;

        # Iteration de $this->default
        foreach ($this->default_config AS $content)

            # Set input
            $this->input[$content['name']] = 

                # Check value in input
                isset($input[$content['name']]) ?

                    # Process input
                    $this->load['forms']->process_input($input[$content['name']], $content) :

                        # Set default value
                        $content['default'];
        
    }

    /** Config Set
     * 
     */
    private function configSetup(){

        

    }

    /** Structure Set
     * 
     */
    private function structureSetup(){



    }

    /** Database Set
     * 
     */
    private function DatabaseSetup(){

        

    }

}