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
    public static function process_input($input = '', array $params = [], array $options = []):array{

        # Set result
        $result = [
            'value' =>  null,
            'error' =>  null,
        ];

        # Type varchar
        if(substr(trim($params['type']), 0, 7) == "VARCHAR"):

            # Check & clean string
            $result['value'] = (is_string($input) || is_numeric($input)) ? 
                trim($input) : 
                    "";
        
        # Type Array
        elseif(substr(trim($params['type']), 0, 5) == "ARRAY"):

            # Check & clean array
            $result['value'] = is_array($input) ?
                $input :
                    [];

        # Type Boolean
        elseif(substr(trim($params['type']), 0, 4) == "BOOL"):

            # Check & clean array
            $result['value'] = $input || !in_array($input, ["false", "null"]) ?
                true :
                    false;

        endif;

        # Return reponse
        return $result;

    }

}