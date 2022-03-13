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
namespace  LuckyPHP\Code;

/** Dependance
 * 
 */
use ReflectionMethod;
use ReflectionClass;

/** Class Forms
 * 
 */
class Objects{

    public static function get_class_methods(object $class, ):array{

        # Declare result
        $result = [];

        # New reflection object
        $reflection = new ReflectionClass($class);

        # Get all methods
        $result = $reflection->getMethods(
            ReflectionMethod::IS_PUBLIC | 
            ReflectionMethod::IS_PROTECTED | 
            ReflectionMethod::IS_PRIVATE
        );

        # Retourne le resultat
        return $result;

    }


}