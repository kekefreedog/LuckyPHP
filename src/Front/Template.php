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
use LightnCandy\LightnCandy;
use LuckyPHP\Server\Config;
use LuckyPHP\Code\Arrays;

/** Class for generate Template
 * 
 */
class Template{
    
    # Config
    private $config = null;

    # Result
    private $result = "";

    # private finder componeent
    private $finder = null;

    /** Constructor
     * 
     */
    public function __construct(){

        # Read config
        $this->configRead();

        # Init light candy
        $this->lightnCandyInit();
        
    }

    /** Read config
     * 
     */
    private function configRead(){

        /* Read config */
        $this->config = Config::read('app') + Config::read('page');

    }

    /** Lightcandy ini
     * 
     */
    public static function lightnCandyInit(){

        /* Prepare main config */
        return [
			'flags' => LightnCandy::FLAG_HANDLEBARSJS,
			'helpers' => [
				'ifEquals' => function ($arg1, $arg2, $options) {
					return ($arg1 === $arg2) ? $options['fn']() : $options['inverse']();
				},
				'cleanString' => function ($string) {
					if($string && is_string($string)):
						/* Reg Ex */
                        $utf8 = [
                            '/[áàâãªä]/u'   =>   'a',
                            '/[ÁÀÂÃÄ]/u'    =>   'a',
                            '/[ÍÌÎÏ]/u'     =>   'i',
                            '/[íìîï]/u'     =>   'i',
                            '/[éèêë]/u'     =>   'e',
                            '/[ÉÈÊË]/u'     =>   'e',
                            '/[óòôõºö]/u'   =>   'o',
                            '/[ÓÒÔÕÖ]/u'    =>   'o',
                            '/[úùûü]/u'     =>   'u',
                            '/[ÚÙÛÜ]/u'     =>   'u',
                            '/ç/'           =>   'c',
                            '/Ç/'           =>   'c',
                            '/ñ/'           =>   'n',
                            '/Ñ/'           =>   'n',
                            '/\s+/'         =>   '_',
                            '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
                            '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
                            '/[“”«»„]/u'    =>   ' ', // Double quote
                            '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160),
                            '/[(]/'			=>	 '',  // Round brackets
                            '/[)]/'			=>	 '',  // Round brackets
                        ];
						/* Return value */
						$string = strtolower(preg_replace(array_keys($utf8), array_values($utf8), $string));
					endif;
					return $string;
				},
				'colorText' => function ($string) {
					return (strpos(trim($string), ' ') !== false) ? 
						str_replace(' ', '-text text-', trim($string)) :
							trim($string).'-text';
				},
				'count' => function ($array = []) {
					return count($array);
				},
                "setAttributes" => function ($array = []) {
                    $result = "";
                    if(is_array($array))
                        foreach ($array as $k => $v){
                            $result .= " $k"; // Push key
                            if(!empty($v))
                                $result .= "=\"".(is_array($v)?implode(" ",$v):$v)."\"";
                        }
                    return $result;
                },
                /** To Js
                 * 
                 * @source https://stackoverflow.com/questions/1500260/detect-urls-in-text-with-javascript
                 * 
                 * function urlify(text) {
                 *   var urlRegex = /(https?:\/\/[^\s]+)/g;
                 *   return text.replace(urlRegex, function(url) {
                 *       return '<a href="' + url + '">' + url + '</a>';
                 *   })
                 *    // or alternatively
                 *    // return text.replace(urlRegex, '<a href="$1">$1</a>')
                 *    }
                 * 
                 */
                "urlify" => function ($string = ''){
                   $regex = "/(https?:\/\/[^\s]+)/";
                   return preg_replace_callback(
                        $regex,
                        function ($url){
                            $url = $url[0];
                            return "<a href=\"$url\" target=\"_blank\">$url</a>";
                        },
                        $string
                   );
                }
			],
		];

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
     * @param array $attributes Custom attributes to add on this tags
     * - Noticed that attributes bypass _user_interface
     */
    public function addHtmlStart(array $attributes = []){

        # Convert attributes to string
        $attributes = Arrays::to_string_attributes($attributes);

        # Set attribute
        $attribute = $attributes ? 
            " ".$attributes : 
                "{{#if _user_interface.framework.html.attributes}} {{{setAttributes _user_interface.framework.html.attributes}}}{{/if}}"; 

        # Add head start
        $this->result .=  "<html$attribute>";

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

    /** Get style
     * - Search global style in www/css/
     * - And specific style for the current page
     */
    public function addStylesheet(){

        # Set result
        $result = "";

        # New finder
        $this->finder = new Finder();

        /* Global css */

        # Search all css at the root of www/css
        $this->finder->files()->name('*.css')->in(__ROOT_WWW__.'css/')->depth('== 0');

        foreach ($this->finder as $file){

            # Get file name
            $filename = $file->getFilename();

            # Push file name in result
            $result .= "<link rel=\"stylesheet\" href=\"css/$filename\">";

        }

        # Pus result in global result
        $this->result .= $result;

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
     * @param array $attributes Custom attributes to add on this tags
     * - Noticed that attributes bypass _user_interface
     */
    public function addBodyStart(array $attributes = []){

        # Convert attributes to string
        $attributes = Arrays::to_string_attributes($attributes);

        # Set attribute
        $attribute = $attributes ? 
            " ".$attributes : 
                "{{#if _user_interface.framework.body.attributes}} {{{setAttributes _user_interface.framework.body.attributes}}}{{/if}}"; 

        # Add head end
        $this->result .= "<body$attribute>";

        # Return this
        return $this;

    }

    /** Load layout
     * 
     * @param array|string $layouts All layout to load
     * @param string|null $templateRoot Root of the template ressources
     */
    public function loadLayouts(array|string $layouts = [], string|null $templateRoot = null){

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

        # Convert layouts to array if string
        if(!is_array($layouts))
            $layouts = [$layouts];

        # Declare
        $result = "";
        $names = [];

        # Get extension from app config
        $ext = $this->config['app']['template']['extension'] ?? "*";

        # New finder
        $this->finder = new Finder();

        # Prepare names
        foreach($layouts as $layout){

            # Check if layout value is string
            if(is_string($layout))

                # Push in names
                $names[] = "*$layout.$ext";

        }

        # Search all file
        $this->finder->files()->name($names)->in($root);

        # Iteration des fichiers trouvés
        foreach ($this->finder as $file){

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

        # Set result
        $result = "";

        # New finder
        $this->finder = new Finder();

        /* Global js */

        # Search all css at the root of www/css
        $this->finder->files()->name('*.js')->in(__ROOT_WWW__.'js/')->depth('== 0');

        foreach ($this->finder as $file){

            # Get file name
            $filename = $file->getFilename();

            # Push file name in result
            $result .= "<script type=\"application/javascript\" src=\"js/$filename\"></script>";

        }

        # Pus result in global result
        $this->result .= $result;

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