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
     * @return void
     */
    public function tree_folder_file_create($structure, $path=__DIR__){

        # Iteration of folder in structure
        foreach ($structure as $folder => $sub_folder)
        
            # If subfolder
            if (is_array($sub_folder)):

                $new_path = "{$path}/{$folder}";

                if ( ! is_dir($new_path))

                    mkdir($new_path);

                call_user_func(__FUNCTION__, $sub_folder, $new_path);
            
            else:
            
                $new_path = "{$path}/{$sub_folder}";

                if ( ! is_dir($new_path))

                    mkdir($new_path);
            
            endif;
        
    }

    /** Application structure
     * 
     */
    public const STRUCTURE_APP = [

        "@root" =>  [
            'www'   =>  [
                'folders'   =>  [
                    'app'       =>  [

                    ],
                    'api'       =>  [

                    ],
                ],
                'files'      =>  [
                    '.htaccess' =>  [
                    ],
                    'index.php' =>  [
                    ]

                ]

            ],
            'resources' =>  [
                'css'       =>  [
                ],
                'js'        =>  [
                ],
                'hbs'       =>  [
                ],
                'md'        =>  [
                ],
            ],
            'config'    =>  [
                'files'      =>  [
                    'settings.yml' =>  [
                    ],
                ]
            ],
            'logs'      =>  [

            ],
            'storage'   =>  [

            ],
        ]

    ];

}