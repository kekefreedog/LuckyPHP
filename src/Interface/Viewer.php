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

/** Interface Viewer
 * 
 */
interface Viewer{

    /** Get response
     * 
     * @return string
     */
    public function getResponse();
    
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

}