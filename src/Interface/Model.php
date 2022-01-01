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

/** Dependance
 * 
 */
use LuckyPHP\Base\Model as ModelBase;

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
     * @return ModelBase
     */
    public function pushErrors(array $errors, int $flag = 0):ModelBase;

    /** Get Errors
     * 
     * @return array
     */
    public function getErrors():array;

    /** Reset Errors
     * @return ModelBase
     */
    public function resetErrors():ModelBase;

    /**********************************************************************************
     * Config
     */

    /** Push confg
     * @param array $config
     *  - Push custom config
     *  - Keys on the root should be string
     * @return ModelBase
     */
    public function pushConfig(array $configs):ModelBase;

    /** Load config
     *  - load application config by name
     * @param array|string $config
     *  - "App"
     *  - ["App", "Routes"]
     *  - * for load all config in Config::CONFIG_PATH
     * @return ModelBase
     * 
     */
    public function loadConfig(array|string $configs):ModelBase;

    /** Get Config
     * 
     * @return array
     */
    public function getConfig():array;

    /**********************************************************************************
     * _user_interface
     */

    /** set Framwork Extra
     * - Set extra data for some framwork
     * @return ModelBase
     */
    public function setFrameworkExtra():ModelBase;

    /** Push data in _user_interface
     * @param array $data Data to push in use interface
     * @param bool $recursive Merge recursively ?
     * @return ModelBase
     */
    public function pushDataInUserInterface(array $data = [], bool $recursive = false):ModelBase;

}