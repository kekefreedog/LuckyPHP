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

/** Dépendances
 * 
 */
use LuckyPHP\File\Files;

/** Class page
 * 
 */
class Structure extends Files{

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
        if(!in_array($action, ['create', 'update', 'delete']))
            return false;

        # Determine source root
        $sourceRoot = is_dir(__ROOT_LUCKYPHP__) ?
            # Root in vendor folder
            __ROOT_LUCKYPHP__ :
                # Case where structure is created in sandbox
                __ROOT_APP__."../../";

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
                            $fileContent['source'] !== null &&
                            $fileContent['source']
                        ){

                            if(file_exists($sourceRoot.$fileContent['source'])){

                                $filepathsource = $sourceRoot.$fileContent['source'];

                            }else{

                                continue;

                            }

                            # Check copy
                            if(!copy($filepathsource, $filepath)){

                                # Erreur de copy

                            }

                        }elseif(
                            isset($fileContent['function']['name']) && 
                            $fileContent['function']['name'] && 
                            method_exists($this, $fileContent['function']['name'])
                        ){

                            # Get new content
                            $newContent = $this->{$fileContent['function']['name']}(...(array_merge([$filepath], ($fileContent['function']['arguments'] ?? []))));

                            # Put new content in file
                            file_put_contents($filepath, $newContent);

                        }else{

                            # Check file no exist
                            if(!file_exists($filepath))

                                # Create empty file
                                file_put_contents($filepath, '');

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

}