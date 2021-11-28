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
namespace  LuckyPHP\Server;

/** Class page
 * 
 */
class Root{

    /** serverRoot
     * 
     *  [
     *      'url'       =>  '',
     *      'directory' =>  '', 
     *      'path_alt'  =>  '',
     *      'path'      =>  '',
     *  ]
     * 
     */
    private $serverRoot = [];

    /** Set root
     *  
     */
    private function set (){

		/** Set root
		 * 
		 * Exemple : localhost/doublescreenproduction_dev/api/upload/
		 * 
		 */
		$this->serverRoot['url'] = ( 
			strpos($_SERVER['HTTP_HOST'], 'localhost') === false ?
				(
					!empty($_SERVER['HTTPS']) ? 
						'https' :
							'http'
				).'://' :
					'' 
		) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		/** Set root dir
		 * 
		 * Exemple : L:/My_Sites/doublescreenproduction_dev/
		 * 
		 */
		$this->serverRoot['directory'] = strpos($_SERVER['HTTP_HOST'], 'localhost') !== false ?
			( $_SERVER['DOCUMENT_ROOT'].'/'.explode('/', $_SERVER['REQUEST_URI'])[1].'/' ) :
				$_SERVER['DOCUMENT_ROOT'].'/';

		# Check root
		if($this->serverRoot['directory'] && strpos($this->serverRoot['directory'], 'index.php')!== false)
					
			# Remove index.php
			$this->serverRoot['directory'] = str_replace('index.php', '', $this->serverRoot['directory']);

		/** Set root path
		 * 
		 * Exemple : /doublescreenproduction_dev (warning when in depth page)
		 * 
		 */
		$this->serverRoot['path_alt'] = strpos($this->serverRoot['url'], 'localhost') !== false ? 
			'/'.str_replace(['localhost', '/'], '', $this->serverRoot['url']) : 
				'';

		/** Set root absolute
		 * 
		 * Fix bug of root path
		 * 
		 * Exemple : /doublescreenproduction_dev
		 * 
		 */
		$this->serverRoot['path'] = strpos($this->serverRoot['url'], 'localhost') !== false ?
			'/'.explode('/', $_SERVER['REQUEST_URI'])[1] :
				'';

    }

    /** Get root
     * 
     */
    public function get():array {

        # Check serverRoot
        if(empty($this->serverRoot))

            # Set root
            $this->set();

        # Return root
        return $this->serverRoot;

    }

}