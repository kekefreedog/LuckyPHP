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
namespace  LuckyPHP\Site;

/** Class page
 * 
 * @dependance root 
 * 
 */
class Pages{

    /** Home
     * 
     */
    public static function actionHome(){

        echo 'hello';

        return 'This is the main page of our simple site';

    }

}