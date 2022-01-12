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
interface Controller{

    /** Get current route pattern
     * 
     * @return string
     */
    public function getRoutePattern():string;

    /** Get all Patterns Allowed for the current root
     * 
     * @return array
     */
    public function getRoutePatterns():array;

    /** Get current methods
     * 
     * @return string
     */
    public function getRouteMethod():string;

    /** Get all methods allowed
     * 
     * @return array
     */
    public function getRouteMethods():array;

    /** Get current name
     * 
     * @return string
     */
    public function getRouteName():string;

    /** Get Content
     * 
     */
    public function getContent();

    /** Get Content Type
     * 
     * @return string
     */
    public function getContentType():string;

    /** Get Response Type
     * 
     * @return string
     */
    public function getResponseType():string;

    /**********************************************************************************
     * Modal
     */

    /** New Modal
     * Create new modal object
     * @return null
     */
    public function newModel():void;

    /** Get Model Result
     * @return array
     */
    public function getModelResult():array;

    /**********************************************************************************
     * Layouts (html constructor)
     */

    /** Set Layouts
     * @param string|array $input templates layouts to load
     * @param bool $merge Merge or replace
     * @return void
     */
    public function setLayouts(string|array $input = [], bool $merge = true):void;

    /** Get Layouts
     * @return array Return values in layouts
     */
    public function getLayouts():array;

    /**********************************************************************************
     * Cookie
     */

    /** Set Cookie
     * @param string|array $input for cookie
     * @return void
     */
    public function setCookie(string|array $input = []):void;

    /** Get Cookie
     * @param string|array $input for cookie
     * @return array
     */
    public function getCookie(string|array $input = []):array;

    /** Remove Cookie
     * @param string|array $input for cookie
     * @return void
     */
    public function removeCookie(string|array $input = []):void;

    /** Clear cookie
     * @return void
     */
    public function clearCookie():void;

}