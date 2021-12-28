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
namespace  LuckyPHP\Front;

/** Depedences
 * 
 */
use Symfony\Component\Finder\Finder;
use LuckyPHP\Server\Exception;
use LuckyPHP\Server\Config;

/** Class for generate Template
 * 
 */
class Template{
    
    # Config
    private $config = null;

    # Result
    private $result = "";

    /** Constructor
     * 
     */
    public function __construct(){

        # Read config
        $this->configRead();
        
    }

    /** Read config
     * 
     */
    private function configRead(){

        /* Read config */
        $this->config = Config::read('app') + Config::read('page');

    }

    /** Add Doctype
     * 
     */
    public function addDoctype(){

        # Add head start
        $this->result .=  "<!DOCTYPE html>";

        # Return this
        return $this;

    }

    /** Add Html
     * 
     */
    public function addHtmlStart(){

        # Add head start
        $this->result .=  '<html class="loading" lang="en" data-textdirection="ltr">';

        # Return this
        return $this;

    }

    /** Head Start
     * 
     */
    public function addHeadStart(){

        # Add head start
        $this->result .=  "<head>";

        # Return this
        return $this;

    }

    /** Add Head Tag
     * 
     * - Read config/page.yml
     * 
     * @param string $branch Branch of the head to load
     */
    public function addHeadMeta($branch = "") {

        # Declare result
        $result = "";

        # Set branch
        if(!$branch)
            $branch = $this->config['page']['head']['default'];

        # Check branch exist
        if(!isset($this->config['page']['head']['branches'][$branch]))

               # Set exception
               throw new Exception("The page's head branch \"$branch\" doesn't exists.", 500);

        # Set branch content
        $branchContent = &$this->config['page']['head']['branches'][$branch];

        # Check not empty
        if(empty($branchContent))
            return;

        # Iteration of tags to create
        foreach($branchContent as $content):

            # Declare element
            $element = "<";

            # Push tag
            $element .= $content['tag'] ?? 'div';

            # Check attributes
            if(isset($content['attributes']) && !empty($content['attributes']))

                # Iteration des attributes
                foreach($content['attributes'] as $attributeName => $attributeValue):

                    # Push attributes name
                    $element .= " $attributeName";

                    # check attributes value is string
                    if(!empty($attributeValue) && !is_array($attributeValue))

                        # Push attributes value
                        $element .= "=\"$attributeValue\"";

                    # Check attributes value is array
                    elseif(!empty($attributeValue)){

                        # Declare Element Value
                        $elementValue = "";

                        # Iteration of the attribute value
                        foreach($attributeValue as $valueKey => $valueName)

                            # Push in elements
                            $elementValue .= 
                                ($elementValue ? ", " : "").
                                $valueKey
                            ;

                            # Check value name
                            if($valueName !== null)
                                $elementValue .= "=$valueName";

                        # Check element value
                        if($elementValue)
                        
                            # Push value in elements
                            $element .= "=\"$elementValue\"";

                    }

                endforeach;

            # Check if value
            if(isset($content['value']))

                # Push value
                $element .= ">".$content['value']."</".$content['tag'];

            $element .= ">";

            # Check element
            if($element && $element != "<>")

                # Push element in result
                $result .= $element;

        endforeach;

        # Push result in global result
        $this->result .= "<head>$result</head>";

        # Return this
        return $this;

    }

    /** Set title
     * 
     * @param string $title title of the page
     * @param bool $dispalyAppName Display name of the app in the page title
     */
    public function setTitle(string $title = "", bool $dispalyAppName = true) {

        # Declare result
        $result = "<title>";

        # Push title
        $result = $title;

        # Check $dispalyAppName
        if($dispalyAppName){

            # Get app name
            $appName = $this->config['app']['name'];

            # Check appname and push it
            if($appName)
                $result .= ($title ? " // " : "").$appName;


        }

        # Set end of tag
        $result = "</title>";

        # Push result in global result
        $this->result .= $result;

        # Return this
        return $this;

    }

    /** Head Start
     * 
     */
    public function addHeadEnd(){

        # Add head end
        $this->result .= "</head>";

        # Return this
        return $this;

    }

    /** Body Start
     * 
     */
    public function addBodyStart(){

        # Add head end
        $this->result .= '<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu 2-columns" data-open="click" data-menu="vertical-dark-menu" data-col="2-columns">';

        # Return this
        return $this;

    }

    /** Load layout
     * 
     * @param array $layouts All layout to load
     * @param string|null $templateRoot Root of the template ressources
     */
    public function loadLayouts(array $layouts = [], string|null $templateRoot = null){

        # 1. Check templates Root
        if($templateRoot === null){

            # Check root exist in config
            if(!isset($this->config['app']['template']['root']))

               # Set exception
               throw new Exception("The root of templates ressources is missing in config file.", 500);

            # Set root
            $root = __ROOT_APP__.$this->config['app']['template']['root'];

        }else

            # Set custom root
            $root = __ROOT_APP__.$templateRoot;

        # 2. Check layouts given
        if(empty($layouts))
            return $this;

        # Declare
        $result = "";
        $names = [];

        # Get extension from app config
        $ext = $this->config['app']['template']['extension'] ?? "*";

        # New finder
        $finder = new Finder();

        # Prepare names
        foreach($layouts as $layout){

            # Check if layout value is string
            if(is_string($layout))

                # Push in names
                $names[] = "*$layout.$ext";

        }

        # Search all file
        $finder->files()->name($names)->in($root);

        # Iteration des fichiers trouvés
        foreach ($finder as $file){

            # Push content in result
            $result .= $file->getContents();

        }

        # Set global result
        $this->result .= $result;

        # Return this
        return $this;

    }

    /** Add index Js
     * 
     */
    public function addIndexJs(){

        # Add script to global result
        $this->result .= '<script type="application/javascript" src="js/index.js"></script>';

        # Return this
        return $this;

    }

    /** Body End
     * 
     */
    public function addBodyEnd(){

        # Add head end
        $this->result .= "</body>";

        # Return this
        return $this;

    }

    /** Html End
     * 
     */
    public function addHtmlEnd(){

        # Add head end
        $this->result .= "</html>";

        # Return this
        return $this;

    }

    /** Build the template
     * 
     */
    public function build(){

        # Return result
        return $this->result;

    }

}