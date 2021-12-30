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
namespace  LuckyPHP\Interface;

/** Interface Controller
 * 
 */
interface Model{

    /**********************************************************************************
     * Data
     */

    /** Execute Model
     * - Return data
     * @return array
     */
    public function execute():array;

    /**********************************************************************************
     * Errors
     */

    /** Push Errors
     * @param array $errors
     *  - One error : [ "code" => 500, "type" => "warn", "detail" => "Oups..." ]
     *  - Multiple errors [ [ "detail" => "Oups..." ], [ "detail" => "Oups..." ] ]  
     * @param int $flag 
     *  - Determine if push _status_code parameters depending of the type of request
     *  - 0 : Auto
     *  - 1 : true
     *  - 2 : false
     * @return void
     */
    public function pushErrors(array $errors, int $flag = 0):void;

    /** Get Errors
     * 
     * @return array
     */
    public function getErrors():array;

    /** Reset Errors
     * @return void
     */
    public function resetErrors():void;

    /**********************************************************************************
     * Config
     */

    /** Push confg
     * @param array $config
     *  - Push custom config
     *  - Keys on the root should be string
     * @return void
     */
    public function pushConfig(array $configs):void;

    /** Load config
     *  - load application config by name
     * @param array|string $config
     *  - "App"
     *  - ["App", "Routes"]
     *  - * for load all config in Config::CONFIG_PATH
     * @return void
     * 
     */
    public function loadConfig(array|string $configs):void;

    /** Get Config
     * 
     * @return array
     */
    public function getConfig():array;

}