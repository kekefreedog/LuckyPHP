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
use LuckyPHP\Server\Config;
use LuckyPHP\Base\Model;

/** First test
 * @test
 */
class ModelTest extends TestCase{

    /** 
     * 
     */
    public function testContext(){

        # Set context
        Config::defineContext([],true,true);

    }

    /** 
     * @author @kekefreedog
     */
    public function testPushAndPop(){

        # New modal instance
        $stack = new Model();

        # Run model
        $schema = $this->run();

        # Check schema not null
        $this->assertTrue(!empty($schema));

    }

}