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
    public function treeFolderGenerator($folders = [], $path = '/', $action = 'create'){

        # Check path has / at the end
        $path = rtrim($path, '/').'/';

        # Check arguments
        if(
            !in_array($action, ['create', 'update', 'delete'])
        )
            return false;

        # Iteration of folders
        foreach($folders as $folderName => $folderContent):

            # Create folder of the root folder if not exist
            if(in_array($action, ['create', 'update'])){
    
                # check path exist
                if(!is_dir($path.$folderName))
    
                    # Create current folder
                    mkdir($path.$folderName, 0777, true);

                # Check files
                if(
                    isset($folderContent['files']) &&
                    is_array($folderContent['files']) &&
                    !empty($folderContent['files'])
                )

                    # Iteration des files
                    foreach ($folderContent['files'] as $filename => $fileContent) {

                        # Get path of the current file
                        $filepath = rtrim($path, '/').'/'.rtrim($folderName, '/').'/'.$filename;
                        
                        # Check source
                        if(
                            isset($fileContent['source']) && 
                            $fileContent['source'] && 
                            file_exists($fileContent['source']) 
                        ){

                            # Check if update
                            if($action == 'update' && file_exists($filepath))

                                # Check copy
                                if(!copy($fileContent['source'], $filepath)){

                                    # Erreur de copy

                                }

                        }elseif(
                            isset($fileContent['function']['name']) && 
                            $fileContent['function']['name'] && 
                            method_exists($this, $fileContent['function']['name'])
                        ){

                            # Open current file
                            $currentFile = fopen($filepath, "w");

                            # Get new content
                            $newContent = $this->{$fileContent['function']['name']}(...($fileContent['function']['parameters'] ?? []));

                            # Clear content of file
                            ftruncate($currentFile, 0);

                            # Put new content into file
                            fwrite($currentFile, $newContent);

                            # Close file
                            fclose($currentFile);

                        }

                    }

                # Check if subfolders
                if(
                    isset($folderContent['folders']) &&
                    is_array($folderContent['folders']) &&
                    !empty($folderContent['folders'])
                )

                    # Call function
                    $this->treeFolderGenerator($folderContent['folders'], $path.$folderName, $action);

            # Action delete
            }elseif($action == 'delete')

                # Check path is not root "/"
                if($path.$folderName !== "/")

                    # Delete folder
                    unlink($path.$folderName);

        endforeach;
        
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

            # Declare reponse
            $reponse =
                "RewriteEngine on".PHP_EOL.
                "RewriteRule ^www/app/.*$ /www/app/ [R=301,L]".PHP_EOL.
                "RewriteRule ^www/api/.*$ /www/api/ [R=301,L]".PHP_EOL
            ;

            # Return reponse
            return $reponse;

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

        "/" =>  [
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
                            'source'    =>  null,
                            'function'  =>  [
                                'name'      =>  'htaccessWrite',
                                'arguments'=>  [
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