<?php
declare(strict_types=1);

namespace Quest\fields;

use Quest\helpers\NumberHelper;

abstract class DateField extends AbstractField
{
    /**
     * List acceptable separator for date field
     */
    const DATE_SEPARATOR = ['.', '-', '/'];
    
    /**
     * Return value of date follow format
     */
    public function getValue(): string
    {
        return $this->initial();
    }

    /**
     * Receive and detect inputs
     */
    private function initial(): string
    {
        foreach(self::DATE_SEPARATOR as $separator) {
            $arrDate = array_map('intval', explode($separator, $this->value));
            if (3 == count($arrDate)) {
                if (4 == strlen((string)$arrDate[0]) && '-' == $separator) {
                    $temp = $arrDate[0];
                    $arrDate[0] = $arrDate[2];
                    $arrDate[2] = $temp;
                }

                return $this->generateDisplayDate($arrDate);
            }
        }

        return '';
    }

    /**
     * Formating process
     */
    private function generateDisplayDate(array $arrDate): string
    {
        $transformedValue = $this->tranformedValue($arrDate);
        if ('' == $transformedValue) {
            return '';
        }
        
        $originString = date(DATE_RFC2822, strtotime($transformedValue));
        $originArray = explode(' ', $originString);
        if (4 > count($originArray)) {
            return '';
        }

        return sprintf(
            '%s %s %s, %s', 
            str_replace(',', '', $originArray[0]),
            NumberHelper::addIndexForNumber((int) $originArray[1]),
            $originArray[2],
            (int) $originArray[3]
        );
    }

    /**
     * Validate date
     */
    private function tranformedValue(array $dateArray): string
    {
        try {
            $year = $this->convertYear($dateArray[2]);
            if (false === checkdate($dateArray[1], $dateArray[0], $year)) {
                throw new Exception('Date does not valid');
            };

            return sprintf('%s-%s-%s', $year, $dateArray[1], $dateArray[0]);
        } catch (Exception $e) {
            return '';
        }
    }

    /**
     * Convert year follow requirement
     */
    private function convertYear($year): int
    {
        if (2 == strlen((string)$year)) {
            $currentYear = (int) date('Y');
            $currentCentury = floor($currentYear / 100);
            $yearGap = $year - $currentYear % 100;
            if ($yearGap <= 5 && $yearGap >= 0) {
                $year = $currentCentury * 100 + $year;
            } else {
                $year = ($currentCentury - 1) * 100 + $year;
            }
        }

        return (int) $year;
    }
}