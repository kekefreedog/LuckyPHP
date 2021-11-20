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
namespace  Kutilities\Server;

/** Class page
 * 
 */
abstract class Page{

    /** serverPage
     * 
     *  [
     *      'php_self'  =>  '',
     *      'name'      =>  '', 
     *      'type'      =>  '',
     *      'ext'       =>  '',
     *  ]
     * 
     */
    protected $serverPage = [];

    /** Set Name
     * 
     */
    protected function nameSet(){

		# Set php self
		$this->pageName['php_self'] = $_SERVER['PHP_SELF'];

		# Prepare current page
		$pageExplode = explode('/', $this->pageName['php_self']);
		$pageNameExplode = explode('.', (end($pageExplode)));

		/* Check api or app or template */
		
		# Delete two last item of array
		array_pop($pageExplode);

		# Script name
		$scriptName = end($pageExplode);
		
		# Delete two last item of array
		array_pop($pageExplode);

		# Get type of page
		$type = end($pageExplode);

		# If type Index
		if(!$type && $pageNameExplode[0] == 'index' && $pageNameExplode[1] == 'php'):

			# Set name & type
			$this->pageName['name'] = $this->pageName['type'] = $pageNameExplode[0];

			# Set ext
			$this->pageName['ext'] = $pageNameExplode[1];
		
		# If type page
		elseif($type == 'app' && $pageNameExplode[0] && $pageNameExplode[1] == 'prod'):

			# Set name
			$this->pageName['name'] = $pageNameExplode[0];

			# Type
			$this->pageName['type'] = 'page';

			# Set ext
			$this->pageName['ext'] = $pageNameExplode[1];

		# If type template
		elseif($pageNameExplode[0] && $pageNameExplode[1] == 'template'):

			# Set name
			$this->pageName['name'] = $pageNameExplode[0];

			# Type
			$this->pageName['type'] = 'template';

			# Set ext
			$this->pageName['ext'] = $pageNameExplode[1];

		# If type script
		elseif($type == 'api'):

			# Set name
			$this->pageName['name'] = $scriptName;

			# Type
			$this->pageName['type'] = 'script';

			# Set ext
			$this->pageName['ext'] = $pageNameExplode[1];
		
		endif;

    }

}