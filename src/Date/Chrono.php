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

/** LuckyPHP
 * 
 */
namespace  LuckyPHP\Date;

/** Class Controller
 * 
 */
class Chrono{

    /**********************************************************************************
    * Parameters
    */

    public $start;
    public $end;
    public $time;

    /**********************************************************************************
    * Constructor
    */

    /** Constructor
     * 
     * @param bool
     */
    public function __construct(bool $start = true){

        # Check start
        if($start)

            # Start chrono
            $this->start();
        
    }

    /**********************************************************************************
    * Hooks
    */

    /** Start chrono
     * @return void
     */
    public function start():void {

        # Start
        $this->start = microtime(true); 

    }

    /** Get start time
     * @return float
     */
    public function getStart():float{

        # Set result
        $result = $this->start;

        # Return result
        return $result;

    }
    
    /** Stop chrono
     * @return float
     */
    public function stop():float{

        # End
        $this->end = microtime(true);

        # Calculate execution time
        $this->time = $this->end - $this->start;

        # Return time
        return $this->time;

    }

    /** Get clean time
     * @param bool Raw or Clean time
     */
    public function getTime(bool $raw = false){

        # check raw
        if($raw):

            # Set response
            $response = $this->time;

        else:

            # Explode time
            $time = explode('.', (string)$this->time);
            
            $hours = (int)($time[0]/60/60);
            $minutes = (int)($time[0]/60)-$hours*60;
            $seconds = (int)$time[0]-$hours*60*60-$minutes*60;
            $milliseconds = substr($time[1], 5, 5) >= 5 ?
            ((int)substr($time[1], 0, 4) + 1) :
                ((int)substr($time[1], 0, 4));

            # Set response
            $response = 
                (($hours < 10 ? 0 : '').$hours).'h'.
                (($minutes < 10 ? 0 : '').$minutes).'m'.
                (($seconds < 10 ? 0 : '').$seconds).'s'.
                $milliseconds.'ms'
            ;

        endif;

        # Retourne la réponse
        return $response;

    }

}