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

/** Dependance
 * 
 */
use LuckyPHP\Server\Config;
use LuckyPHP\Code\Strings;
use LuckyPHP\File\Files;

/** Class Controller
 * 
 */
class Controller{

    /**********************************************************************************
     * Synchronize
     */

    /** Generate controller depending of roots config file
     * @return void
     */
    public function __construct(){

        # Set routes
        $routes = Config::read('routes');

        # Check routes
        if(!empty($routes['routes']))

            # Iteration des routes
            foreach($routes['routes'] as $route):

                # Set name
                $name = Strings::snakeToCamel($route['name'], true);

                # Set route file
                $rootFile = __ROOT_APP__.self::PATH."/".$name."Action.php";

                # Check if action already exists in controller folder
                if(file_exists($rootFile))
                    continue;

                # set context
                $context = (isset($route['error']) && $route['error']) ?
                    "error" :
                        $route['response'];

                # check if custom controller
                if(in_array($route['response'], ['favicon']))

                    # Set method name
                    $methodName = strtolower($route['response'])."Generator";

                # Response controller
                else

                    # Set method name
                    $methodName = strtolower($context)."Generator";
                    
                # Check method exist for get content
                if(!method_exists($this, $methodName))
                    continue;

                # Get content
                $content = $this->{$methodName}($name);

                # Check content
                if(!$content)
                    continue;

                # Put Content in file
                file_put_contents($rootFile, $content);

            endforeach; 

    }

    /**********************************************************************************
     * Generator
     */

    /** Html content generator
     *  @param string $name Name of the root
     */
    public static function htmlGenerator(string $name = ""):string {

        # Set content
        $result = "";

        # Add header
        $result .= self::_headerLayout();
        
        # Add dependance
        $result .= self::_dependanceLayout();

        # Push content
        $result .= 
            "/** Class for manage the workflow of the app".PHP_EOL.
            " *".PHP_EOL.
            " */".PHP_EOL.
            "class ".$name."Action extends ControllerBase implements ControllerInterface{".PHP_EOL.
            PHP_EOL.
            "    /** Constructor".PHP_EOL.
            "     *".PHP_EOL.
            "     */".PHP_EOL.
            '    public function __construct(...$arguments){'.PHP_EOL.
            PHP_EOL.
            "        # Parent constructor".PHP_EOL.
            '        parent::__construct(...$arguments);'.PHP_EOL.
            PHP_EOL.
            "        # Setup layouts".PHP_EOL.
            '        $this->setupLayouts();'.PHP_EOL.
            PHP_EOL.
            "        # Prepare modal".PHP_EOL.
            '        $this->modelAction();'.PHP_EOL.
            PHP_EOL.
            "    }".PHP_EOL.
            PHP_EOL.
            "    /** Setup layouts".PHP_EOL.
            "     * ".PHP_EOL.
            "     */".PHP_EOL.
            "    private function setupLayouts(){".PHP_EOL.
            PHP_EOL.
            "        # Set layouts".PHP_EOL.
            '        $this->setLayouts(['.PHP_EOL.
            "            'structure/head',".PHP_EOL.
            "            'structure/sidenav',".PHP_EOL.
            "            'page/home',".PHP_EOL.
            "        ]);".PHP_EOL.
            PHP_EOL.
            "    }".PHP_EOL.
            PHP_EOL.
            "    /** Model action".PHP_EOL.
            "     * ".PHP_EOL.
            "     */".PHP_EOL.
            "    private function modelAction(){".PHP_EOL.
            PHP_EOL.
            "        # New model".PHP_EOL.
            '        $this->newModel();'.PHP_EOL.
            PHP_EOL.
            "        # Load app config".PHP_EOL.
            '        $this->model'.PHP_EOL.
            "            ->loadConfig('app')".PHP_EOL.
            "            ->setFrameworkExtra()".PHP_EOL.
            "            ->pushDataInUserInterface()".PHP_EOL.
            "            ->pushCookies(true)".PHP_EOL.
            "            ->pushContext()".PHP_EOL.
            "        ;".PHP_EOL.
            PHP_EOL.
            '        //\LuckyPHP\Front\Console::log($this->model->execute());'.PHP_EOL.
            PHP_EOL.
            "    }".PHP_EOL.
            PHP_EOL.
            "    /** Response".PHP_EOL.
            "     *".PHP_EOL.
            "     */".PHP_EOL.
            "    public function response(){".PHP_EOL.
            PHP_EOL.
            "        # Return reponse".PHP_EOL.
            '        return $this->name;'.PHP_EOL.
            PHP_EOL.
            "    }".PHP_EOL.
            "}".PHP_EOL
        ;

        # return result
        return $result;

    }

    /** Data content generator
     *  @param string $name Name of the root
     */
    public static function dataGenerator(string $name = ""){

        # Set content
        $result = "";

        # Add header
        $result .= self::_headerLayout();
        
        # Add dependance
        $result .= self::_dependanceLayout();

        # Set result
        $result .= 
            "/** Class for manage the workflow of the app".PHP_EOL.
            " *".PHP_EOL.
            " */".PHP_EOL.
            "class ".$name."Action extends ControllerBase implements ControllerInterface{".PHP_EOL.
            PHP_EOL.
            "    /** Constructor".PHP_EOL.
            "     *".PHP_EOL.
            "     */".PHP_EOL.
            '    public function __construct(...$arguments){'.PHP_EOL.
            PHP_EOL.
            "        # Parent constructor".PHP_EOL.
            '        parent::__construct(...$arguments);'.PHP_EOL.
            PHP_EOL.
            "        # Prepare modal".PHP_EOL.
            '        $this->modelAction();'.PHP_EOL.
            PHP_EOL.
            "    /** Model action".PHP_EOL.
            "     * ".PHP_EOL.
            "     */".PHP_EOL.
            "    private function modelAction(){".PHP_EOL.
            PHP_EOL.    
            "        # New model".PHP_EOL.
            '        $this->newModel();'.PHP_EOL.
            PHP_EOL.
            "        # Set file".PHP_EOL.
            '        $this->model->getFile("data-error.png", __ROOT_APP__."vendor/kekefreedog/luckyphp/resources/png/Error/");'.PHP_EOL.
            PHP_EOL.
            "    }".PHP_EOL.
            PHP_EOL.
            "    }".PHP_EOL.
            PHP_EOL.
            "    /** Response".PHP_EOL.
            "     *".PHP_EOL.
            "     */".PHP_EOL.
            "    public function response(){".PHP_EOL.
            PHP_EOL.
            "        # Return reponse".PHP_EOL.
            '        return $this->name;'.PHP_EOL.
            PHP_EOL.
            "    }".PHP_EOL.
            "}".PHP_EOL
        ;

        # Return result
        return $result;

    }

    /** Json content generator
     *  @param string $name Name of the root
     */
    public static function jsonGenerator(string $name = ""){

        # Set result
        $result = "";

        # Add header
        $result .= self::_headerLayout();
        
        # Add dependance
        $result .= self::_dependanceLayout();

        # Push content
        $result .= 
            "/** Class for manage the workflow of the app".PHP_EOL.
            " *".PHP_EOL.
            " */".PHP_EOL.
            "class ".$name."Action extends ControllerBase implements ControllerInterface{".PHP_EOL.
            PHP_EOL.
            "    /** Constructor".PHP_EOL.
            "     *".PHP_EOL.
            "     */".PHP_EOL.
            '    public function __construct(...$arguments){'.PHP_EOL.
            PHP_EOL.
            "        # Parent constructor".PHP_EOL.
            '        parent::__construct(...$arguments);'.PHP_EOL.
            PHP_EOL.
            "        # Prepare Cookie".PHP_EOL.
            '        $this->action();'.PHP_EOL.
            PHP_EOL.
            '    }'.PHP_EOL.
            PHP_EOL.
            '    # Prepare Data'.PHP_EOL.
            "    private function action(){".PHP_EOL.
            PHP_EOL.
            "        # New model".PHP_EOL.
            '        $this->newModel();'.PHP_EOL.
            PHP_EOL.
            "        // Push records".PHP_EOL.
            '        $this->model->pushRecords("Hello Json");'.PHP_EOL.
            PHP_EOL.
            "    }".PHP_EOL.
            PHP_EOL.
            "    /** Response".PHP_EOL.
            "     *".PHP_EOL.
            "     */".PHP_EOL.
            "    public function response(){".PHP_EOL.
            PHP_EOL.
            "        # Return reponse".PHP_EOL.
            '        return $this->name;'.PHP_EOL.
            PHP_EOL.
            "    }".PHP_EOL.
            PHP_EOL.
            "}".PHP_EOL
        ;

        # return result
        return $result;

    }

    /** Error content generator
     *  @param string $name Name of the root
     */
    public static function errorGenerator(string $name = ""){

        # Set content
        $result = "";

        # Add header
        $result .= self::_headerLayout();
        
        # Add dependance
        $result .= self::_dependanceLayout();

        # Set result
        $result .= 
            "/** Class for manage the workflow of the app".PHP_EOL.
            " *".PHP_EOL.
            " */".PHP_EOL.
            "class ".$name."Action extends ControllerBase implements ControllerInterface{".PHP_EOL.
            PHP_EOL.
            "    /** Constructor".PHP_EOL.
            "     *".PHP_EOL.
            "     */".PHP_EOL.
            '    public function __construct(...$arguments){'.PHP_EOL.
            PHP_EOL.
            "        # Parent constructor".PHP_EOL.
            '        parent::__construct(...$arguments);'.PHP_EOL.
            PHP_EOL.
            "        # New Exception".PHP_EOL.
            '        $e = new Exception("The page you are looking for doesn\'t exist", 404);'.PHP_EOL.
            PHP_EOL.
            "        # Display html".PHP_EOL.
            '        $e->getHtml();'.PHP_EOL.
            PHP_EOL.
            "    }".PHP_EOL.
            PHP_EOL.
            "    /** Response".PHP_EOL.
            "     *".PHP_EOL.
            "     */".PHP_EOL.
            "    public function response(){".PHP_EOL.
            PHP_EOL.
            "        # Return reponse".PHP_EOL.
            '        return $this->name;'.PHP_EOL.
            PHP_EOL.
            "    }".PHP_EOL.
            "}".PHP_EOL
        ;

        # Return result
        return $result;

    }

    /** Favicon content generator
     *  @param string $name Name of the root
     */
    public static function faviconGenerator(string $name = "favicon"){

        # Set content
        $result = "";

        # Add header
        $result .= self::_headerLayout();
        
        # Add dependance
        $result .= self::_dependanceLayout();

        # Set result
        $result .= 
            "/** Class for manage the workflow of the app".PHP_EOL.
            " *".PHP_EOL.
            " */".PHP_EOL.
            "class ".$name."Action extends ControllerBase implements ControllerInterface{".PHP_EOL.
            PHP_EOL.
            "    /** Constructor".PHP_EOL.
            "     *".PHP_EOL.
            "     */".PHP_EOL.
            '    public function __construct(...$arguments){'.PHP_EOL.
            PHP_EOL.
            "        # Parent constructor".PHP_EOL.
            '        parent::__construct(...$arguments);'.PHP_EOL.
            PHP_EOL.
            "        # Prepare modal".PHP_EOL.
            '        $this->modelAction();'.PHP_EOL.
            PHP_EOL.
            "    }".PHP_EOL.
            PHP_EOL.
            "    /** Model action".PHP_EOL.
            "     * ".PHP_EOL.
            "     */".PHP_EOL.
            "    private function modelAction(){".PHP_EOL.
            PHP_EOL.    
            "        # New model".PHP_EOL.
            '        $this->newModel();'.PHP_EOL.
            PHP_EOL.
            "        # Set file".PHP_EOL.
            '        $this->model->getFile("data-error.png", __ROOT_APP__."vendor/kekefreedog/luckyphp/resources/png/Error/");'.PHP_EOL.
            PHP_EOL.
            "    }".PHP_EOL.
            PHP_EOL.
            "    /** Response".PHP_EOL.
            "     *".PHP_EOL.
            "     */".PHP_EOL.
            "    public function response(){".PHP_EOL.
            PHP_EOL.
            "        # Return reponse".PHP_EOL.
            '        return $this->name;'.PHP_EOL.
            PHP_EOL.
            "    }".PHP_EOL.
            "}".PHP_EOL
        ;

        # Return result
        return $result;

    }

    /**********************************************************************************
     * Layouts
     */

    /** Return layout of header
     * 
     */
    private static function _headerLayout(){

        # Set result
        $result =
            "<?php declare(strict_types=1);".PHP_EOL.
            "/*******************************************************".PHP_EOL.
            " * Copyright (C) 2019-2021 Kévin Zarshenas".PHP_EOL.
            " * kevin.zarshenas@gmail.com".PHP_EOL.
            " *".PHP_EOL.
            " * This file is part of LuckyPHP.".PHP_EOL.
            " *".PHP_EOL.
            " * This code can not be copied and/or distributed without the express".PHP_EOL.
            " * permission of Kévin Zarshenas @kekefreedog".PHP_EOL.
            " *******************************************************/".PHP_EOL.
            PHP_EOL.
            "/** Namespace".PHP_EOL.
            " *".PHP_EOL.
            " */".PHP_EOL.
            "namespace App\Controllers;".PHP_EOL.
            PHP_EOL
        ;

        # Return result
        return $result;

    }

    /** Return layout of dependance
     * 
     */
    private static function _dependanceLayout(){

        # Set result
        $result =
            "/** Dependances".PHP_EOL.
            " *".PHP_EOL.
            " */".PHP_EOL.
            "use LuckyPHP\Interface\Controller as ControllerInterface;".PHP_EOL.
            "use LuckyPHP\Base\Controller as ControllerBase;".PHP_EOL.
            "use LuckyPHP\Server\Exception;".PHP_EOL.
            PHP_EOL
        ;

        # Return result
        return $result;

    }

    /**********************************************************************************
     * Constants
     */

    # Type of root
    public const TYPES = [ 'html', 'data', 'json' ];

    # Path of the controllers
    public const PATH = "src/Controllers";


}