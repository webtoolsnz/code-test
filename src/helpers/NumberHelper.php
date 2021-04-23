<?php

namespace Quest\helpers;

class NumberHelper {

    /**
     * Add suffix to number follow English rule
     */
    static function addIndexForNumber($number): string
    {
        if (filter_var($number, FILTER_VALIDATE_INT) === false ) {
            return '';
        }
        
        switch($number)
        {
            case 1:
                return $number . 'st';
            case 2:
                return $number . 'nd';
            case 3:
                return $number . 'rd';
            default:
                return $number . 'th';
        }
    }
}
