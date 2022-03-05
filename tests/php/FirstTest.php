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

/** Register The Auto Loader (composer)
 * 
 */
require __DIR__.'/../../vendor/autoload.php';

/** Namespace
 * 
 */
/* namespace  LuckyPHP\Base; */

/** Dependances
 * 
 */
use PHPUnit\Framework\TestCase;

/** First test
 * @test
 */
class FirstTest extends TestCase{

    public function testCheck(){
        // Check the test is working
        $this->assertTrue(true);
    }

}