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

/** Dependances
 * 
 */
use LuckyPHP\Interface\Exception as InterfaceException;
use LuckyPHP\Kit\StatusCodes;
use LuckyPHP\Front\Template;
use LightnCandy\LightnCandy;
use LuckyPHP\Front\Console;

/** Class for error
 * 
 * @source https://www.php.net/manual/en/language.exceptions.php
 * 
 */
class Exception extends \Exception implements InterfaceException{

    // Exception message
    protected $message = 'Unknown exception';

    // User-defined exception code                       
    protected $code = 0;

    // Source of the error LuckyPHP or App or Vendor
    public $source = null;

    /** Construct
     * 
     */
    public function __construct($message = null, $code = 0){

        // Check message
        if (!$message)
            throw new $this('Unknown '.get_class($this));

        // Construct parent
        parent::__construct($message, $code);

        // Set source
        $this->setSource();

        // Right in log file
        $this->logWrite();

    }
   
    /** Convert to string
     * 
     */
    public function __toString(){

        # Code
        $code = $this->getCode();

        # File
        $file =
        implode( 
            '/',
            array_slice(
                explode(
                    '/', 
                    str_replace(
                        ['\\', '.php'], 
                        ['/', ''], 
                        $this->getFile()
                    )
                ),
                -2
            )
        );

        # Set message
        $message = "⚠️ [Error $code : ".StatusCodes::GET[$code]['title']."] ".
            $this->getMessage()." (on the file ../$file line ".$this->getLine().")";

        // Retourne message
        return $message;

    }

    /** Set Source
     * 
     */
    private function setSource(){

        # Get file
        $file = $this->getFile();

        # Replace antislash
        $file = str_replace('\\', '/', $file);

        # Check if error comme from LuckyPhp
        if(strpos($file, "/vendor/kekefreedog/luckyphp/") !== false){

            # Set source
            $this->source = 'luckyphp';

        }else
        # Check if error comme from Vendor
        if(strpos($file, "/vendor/") !== false){

            # Set source
            $this->source = 'vendor';

        }else
        # Check if error comme from App
        {

            # Set source
            $this->source = 'app';

        }

    }

    /** Get Source
     * 
     *
     */
    public function getSource(){

        # Get source
        $result = $this->source;

        # Return result
        return $result;

    }

    /** Display message as error message in javascript console
     * 
     */
    public function consoleError(){

        # Put error in console
        Console::error($this->__toString());

    }

    /** Log write
     * 
     */
    private function logWrite(){

        # Get source
        $source = $this->getSource();

        # Check source
        if($source !== null)

            # Generate log
            error_log(
                date("Y-m-d H:i:s", time())." : ".$this->__toString().PHP_EOL,
                3,
                __ROOT_APP__."/logs/$source.log"
            );

    }

    /** Display Html Response
     * 
     */
    public function getHtml(){

        # Get code
        $code = $this->getCode();

        # Parameters
        $parmeters = [
            '_user_interface'   =>  [
                'message'   =>  $this->getMessage()
            ]
        ];
        # Add details
        $parmeters['_user_interface'] = 
            $parmeters['_user_interface'] +
            ((StatusCodes::GET[$this->code] ?? StatusCodes::DEFAULT))
        ;

        # Prepare template
        $template = New Template();
        $content = $template
            ->addDoctype()
            ->addHtmlStart()
                ->addHeadStart()
                    ->addStylesheet()
                    ->setTitle("Error $code")
                ->addHeadEnd()
                ->addBodyStart()
                    ->loadLayouts('error')
                ->addBodyEnd()
            ->addHtmlEnd()
            ->build()
        ;

        # Compile template
        $compile = LightnCandy::compile($content, Template::lightnCandyInit());

        # Prepare render
        $render = LightnCandy::prepare($compile);

        # Echo render
        echo $render($parmeters);

    }

}