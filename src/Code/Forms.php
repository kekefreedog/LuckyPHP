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
namespace  LuckyPHP\Code;

/** Class Forms
 * 
 */
class Forms{

    /** Process input
     * 
     * @param string|bool|array $input Value to process
     * @param array $params Parameters of value to process
     * @param array $options Optionnal other parameters
     */
    function process_input($input = '', array $params = [], array $options = []):array{

        # Set result
        $result = [
            'value' =>  null,
            'error' =>  null,
        ];

        # Type varchar
        if(substr(trim($params['type']), 0, 7) == "VARCHAR"):

            #return (is_string($input) || is_numeric($input)) ? trim($input) : "";

        endif;

        # Return reponse
        return $result;

    }

}