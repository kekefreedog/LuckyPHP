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
namespace  LuckyPHP\Http;

/** Dependances
 * 
 */
use LuckyPHP\File\Json;

/** Class records
 * 
 */
class Records{

    /** Format Record
     * Format record depending of standard
     * @param array $record
     * @return array
     */
    public static function formatRecord(array $record):array{

        # Declare response
        $response = [];

        # Check record
        if(empty($record))
            return $response;

        # Fill default record value
        $response = [
            "id"            =>  null,
            "entity"        =>  null,
            "attributes"    =>  [],
            "relationships" =>  [],
        ];

        # Iteration record
        foreach($record as $k => $v){
            
            # Check if id or entity
            if(in_array($k, ["id", "entity"])):

                # Set response
                $response[$k] = $v;

            # Else push as attributes
            else:

                # Check if value is json
                if(Json::check($v))

                    # Set v
                    $v = json_decode($v, true);

                # Set attributes
                $response['attributes'][$k] = $v;

            endif;

        }

    }

    /** Format Records
     * Format records depending of standard
     * @param array $record
     * @return array
     */
    public static function formatRecords(array $records):array{

        # Declare response
        $response = [];

        # Check records
        if(!empty($records))

            # Iteration of records
            foreach($records as $record)

                # format record and push it in response
                $response[] = Records::formatRecord($record);

        # Return response
        return $response;

    }

}