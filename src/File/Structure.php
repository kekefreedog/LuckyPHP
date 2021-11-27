<?php declare(strict_types=1);
/*******************************************************
 * Copyright (C) 2019-2021 Kévin Zarshenas
 * kevin.zarshenas@gmail.com
 * 
 * This file is part of Double Screen.
 * 
 * This code can not be copied and/or distributed without the express
 * permission of Kévin Zarshenas @kekefreedog
 *******************************************************/

/** Namespace
 * 
 */
namespace  Kutilities\File\Structure;

/** Class page
 * 
 */
class Structure{

    /**
     * Creates directories based on the array given
     * 
     * @source https://gist.github.com/timw4mail/4172083
     *
     * @param array $structure
     * @param string $path
     * @param string $action 'create', 'update' or 'delete'
     * @return void
     */
    public function treeFolderGenerator($structure = [], $path = '/', $action = 'create'){

        # Check parameters
        if(
            empty($structure) ||
            !in_array($action, ['create', 'update', 'delete']) ||
            !$path
        )
            return false;
        

        # Iteration of folder on root of structure
        foreach ($structure as $content)

            # Check action
            if(in_array($action, ['create', 'update'])){

                # check path exist
                if(!is_dir($path))

                    # Create folder
                    mkdir($path, 0777, true);

                # Check file
                if(
                    isset($content['files']) &&
                    is_array($content['files']) &&
                    !empty($content['files'])
                )

                    # Iteration des files
                    foreach ($content['files'] as $key => $value) {
                        


                    }

                # Check file
                if(
                    isset($content['folders']) &&
                    is_array($content['folders']) &&
                    !empty($content['folders'])
                )

                    #Iteration folders
                    foreach ($content['folders'] as $foldername => $foldercontent)

                        # Call function
                        call_user_func(__FUNCTION__, $foldercontent, $path.$foldername, $action);

            # Action Delete
            }elseif($action == 'delete')

                # Check path is not root "/"
                if($path !== "/")

                    unlink($path);
        
    }

    /**
     * 
     * Creation of specific file
     * 
     */

        /** .htaccess
         * 
         * Write the htaccess file on www folder
         * @param bool $overwrite
         * 
         */
        public function htaccessWrite($overwrite = false){

            # Get path where write the file
            $path = scandir('./');

        }

    /**
     * 
     * Creation of specific file end
     * 
     */

    /** Application structure
     * 
     * 
     */
    public const STRUCTURE_APP = [

        "@root" =>  [
            'folders'=>  [
                'www'   =>  [
                    'folders'   =>  [
                        'app'       =>  [

                        ],
                        'api'       =>  [

                        ],
                    ],
                    'files'      =>  [
                        '.htaccess' =>  [
                            'function'  =>  [
                                'name'      =>  'htaccessWrite',
                                'parameters'=>  [
                                    true,
                                ],
                            ],
                        ],
                        'index.php' =>  [
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