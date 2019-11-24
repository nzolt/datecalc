<?php


namespace App\Data;

use App\Data\Validator\InvaliDateException;

/**
 * Class DateValidator
 * @package App\Data
 */
class DateValidator
{
    /**
     * @param string $date
     * @param string $format
     * @return bool
     */
    public static function validateDate(string $date, string $format = 'Y/m/d H:i'): bool
    {
        if(strlen($date) == 10){
            $date = $date . ' 00:00';
        }
        if(self::validateFormat($date)){
            $d = \DateTime::createFromFormat($format, $date);
            $cd = new \DateTime();
            return $d && $d->format($format) === $date && ($d->getTimestamp() < $cd->getTimestamp());
        }

        return false;
    }

    /**
     * Validate string DateTime format "Y-m-d H:i:s"
     * @param string $date
     * @return bool
     */
    public static function validateFormat(string $date): bool
    {
        if (preg_match("/(\d{4})\/(\d{2})\/(\d{2}) (\d{2}):(\d{2})/", $date)) {
            return true;
        } else {
            throw new InvaliDateException();
        }

        return false;
    }
}