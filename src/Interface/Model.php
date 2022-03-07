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
    
    /****************************************************************
    * Hooks
    */

    /** Run Model
     * - Run modal structure and return reponse
     * @return array
     */
    public function run():array;

    /** Lock model schema
     * @param bool|null $flag Value :
     *  - null : Return current lock status
     *  - true : Lock schema
     *  - false : Unlock schema
     * @return bool
     */
    public function lock(bool|null $flag = null):bool;

    /****************************************************************
     * > Errors
     */

    /** Push Errors
     * Add errors in modal
     * @param array $errors
     *  - One error : [ "code" => 500, "type" => "warn", "detail" => "Oups..." ]
     *  - Multiple errors [ [ "detail" => "Oups..." ], [ "detail" => "Oups..." ] ]  
     * @param int $flag 
     *  - Determine if push _status_code parameters depending of the type of request
     *  - 0 : Auto
     *  - 1 : true
     *  - 2 : false
     * @param bool $exit_error Stop the script and return error
     * @return ModelBase
     */
    public function pushErrors(array $errors, int $flag = 0, bool $exit_error = false):ModelBase;

    /** Get Errors
     * Get the list of all errors in the modal
     * @return array
     */
    public function getErrors():array;

    /** Reset Errors
     * Delete all errors in modal
     * @return ModelBase
     */
    public function resetErrors():ModelBase;

    /****************************************************************
     * > Records
     */

    /** Pushs records
     * @param array $records Records to push in records
     * @param string|null $flag Option about records pushed :
     *  - null : Push all records
     *  - "single" : Push only one record
     * @return ModelBase
     */
    public function pushRecords(array $records = [], string|null $flag = null):ModelBase;

    /** Pushs records
     * @param string $records String for the query in bdd
     * @param string $database If empty take the dafault bdd
     * @return ModelBase
     */
    public function pushRecordsQuery(string $sql_query = "", \PDO|null $database = null):ModelBase;

    /****************************************************************
     * > File
     */
    
    /** Get File
     * Exemple of response :
     * [
     *      "path"  =>  "/img/toto.png"
     *      "header =>  [
     *          "Content-Type"  =>  "text/plain"
     *      ]
     * ]
     * @param string $name Name of the file your are looking for
     * @param string $path Path of the file
     * @param array $ext Extensions of the file
     * @param bool $recursive Determine if finder search in subfolder
     * @return ModelBase - Return first file found
     *  - path
     *  - header
     *      - Content-Type : "text/plain"
     */
    public function getFile(string $name = "", string $path = "", array $ext = [], bool $recursive = true):ModelBase;

    /** Read File
     * Exemple of response :
     * [
     *      "path"  =>  "/img/toto.png"
     *      "header =>  [
     *          "Content-Type"  =>  "text/plain"
     *      ]
     * ]
     * @param string $path Path of the file
     * @return ModelBase - Return first file found
     */
    public function readFile(string $path = ""):ModelBase;

    /** Push file content
     * @param string $path Exemple : "/img/toto.png"
     * @param array $header custom data to push in header. Exemple : 
     *  [
     *      "Content-Type"  =>  "text/plain"
     *  ]
     * @return ModelBase
     */
    function pushFile(string $path = "", array $header = []):ModelBase;

    /****************************************************************
     * > Metadata
     */

    /** Set Pagination
     * @param int $page Current page
     * @param int $pagination Number of records by page
     * @return ModelBase
     */
    public function setRecordsPagination(int $page = 1, int $pagination = 25):ModelBase;

    /****************************************************************
     * > User Interface
     */

    /** set Framwork Extra
     * - Set extra data of framework framwork
     * @return ModelBase
     */
    public function setFrameworkExtra():ModelBase;

    /** Push data in _user_interface
     * @param array $data Data to push in use interface
     * @param bool $recursive Merge recursively ?
     * @deprecateds
     * @return ModelBase
     */
    public function pushDataInUserInterface(array $data = [], bool $recursive = false):ModelBase;

    /** Push Action
     * @param string $type Type of action :
     *  - Update
     *  - Delete
     *  - Add
     * @param array|string $target Target of the action (css selector) 
     * @return ModelBase
     */
    public function pushAction(string $type = "update", array|string $target = "#main"):ModelBase;

    /****************************************************************
     * > Config
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

    /****************************************************************
     * > Cookies
     */

    /** Push Cookies
     * @param bool $expand Allow to expend cookie when they have "_"
     * @return ModelBase
     */
    public function pushCookies(bool $expand = false):ModelBase;

    /****************************************************************
     * > Context
     */

    /** Push info
     * @return ModelBase
     */
    public function pushContext():ModelBase;

}