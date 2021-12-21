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

/** Dependance
 * 
 */
use Mezon\Router\Router AS MezonRooter;

/** Class page
 * 
 * @dependance root 
 * 
 */
class Rooter{

    # Declare instance
    private $instance = null;

    /** Constructor
     * 
     */
    public function __construct(){
        
        # Set instance
        $instance = new MezonRooter();

        var_dump($instance->getListOfSupportedRequestMethods());

    }


}