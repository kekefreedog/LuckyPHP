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
use LuckyPHP\Server\Exception;
use LuckyPHP\Server\Config;

/** Class for generate Template
 * 
 */
abstract class Template{
    
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


    /** Add Head Tag
     * 
     * - Read config/page.yml
     * 
     * @param string $branch Branch of the head to load
     * @return void
     */
    public function addHead($branch = ""):void {

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
                                "$valueKey=$valueName"
                            ;

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

    }

    /** Build the template
     * 
     */
    public function build(){

        # Return result
        return $this->result;

    }

}