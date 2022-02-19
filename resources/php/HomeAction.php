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
namespace App\Controllers;

/** Dependances
 *
 */
use LuckyPHP\Interface\Controller as ControllerInterface;
use LuckyPHP\Base\Controller as ControllerBase;

/** Class for manage the workflow of the app
 *
 */
class HomeAction extends ControllerBase implements ControllerInterface{

    /** Constructor
     *
     */
    public function __construct(...$arguments){

        # Parent constructor
        parent::__construct(...$arguments);

        # Setup layouts
        $this->setupLayouts();

        # Prepare modal
        $this->modelAction();

    }

    /** Setup layouts
     * 
     */
    private function setupLayouts(){

        # Set layouts
        $this->setLayouts([
            'structure/head',
            'structure/sidenav',
            'page/home',
        ]);

    }

    /** Model action
     * 
     */
    private function modelAction(){

        # New model
        $this->newModel();

        # Load app config
        $this->model
            ->loadConfig('app')
            ->setFrameworkExtra()
            ->pushDataInUserInterface()
            ->pushCookies(true)
            ->pushContext()
        ;

        //\LuckyPHP\Front\Console::log($this->model->execute());

    }

    /** Response
     *
     */
    public function response(){

        # Return reponse
        return $this->name;

    }
}