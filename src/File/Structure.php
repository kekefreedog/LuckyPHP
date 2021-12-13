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
                "# Enable rerwrite".PHP_EOL.
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
        public function composerUpdate(){

            // Path of the file
            $filePath = '../../../composer.json';
            # A remplacer par __ROOT_APP__."/composer.json";

            // Check composer.json exist
            if(is_file($filePath));

            // Read composer.json
            $object = $raw = file_get_contents($filePath);

            /** Update object check if content has :
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
            if(
                $object &&
                isset($object["autoload"]["psr-4"]["App\\"]) && 
                is_array(isset($object["autoload"]["psr-4"]["App\\"])) && 
                in_array("src/", (array)$object["autoload"]["psr-4"]["App\\"])
            )
                return true;

            $object["autoload"]["psr-4"]["App\\"][] = "src/";

            // Check if update change anything
            if($object === $raw)
                return true;

            // Write new object in file
            file_put_contents($filePath, $object);

            // Return true
            return true;

        }

    /**
     * 
     * Creation of specific file end
     * 
     */

}