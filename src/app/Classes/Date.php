<?php

namespace App\Classes;

use Carbon\Carbon;
use DateTimeInterface;

class Date
{
    /**
     * Convert a date to a formatted string using the given iso format.
     *
     * @param string $strIsoFormat
     * @param DateTimeInterface|null $objDate
     * @return string
     */
    public static function dateToString(string $strIsoFormat, DateTimeInterface $objDate = null): string
    {
        if (empty($objDate)) {
            if (!is_null($objDate)) {
                $objCarbon = new Carbon();
            } else {
                return "";
            }
        } else {
            $objCarbon = new Carbon($objDate);
        }

        return $objCarbon
            ->locale(setlocale(LC_CTYPE, 0))
            ->isoFormat($strIsoFormat);
    }

    /**
     * Converts Data string with given arrays.
     *
     * @param array $arrValues1
     * @param array $arrValues2
     * @param string $strSanitizedDate
     * @param string $strCode
     * @param string $strIsoFormat
     * @return string
     */
    protected static function arrayReplace(
        array $arrValues1,
        array $arrValues2,
        string $strSanitizedDate,
        string $strCode,
        string $strIsoFormat
    ): string {
        //*** Check if there is a delimiter used before and/or after int the iso format.
        [$intPosition, $strDelimiter] =  self::findDelimiter($strIsoFormat, $strCode);

        //*** Extend the values in the array with the delimiter on the right position.
        $arrValues1 = self::extendArrayValues($arrValues1, $intPosition, $strDelimiter);
        $arrValues2 = self::extendArrayValues($arrValues2, $intPosition, $strDelimiter);

        return str_ireplace($arrValues1, $arrValues2, $strSanitizedDate);
    }

    /**
     * Find delimiter in string and position.
     *
     * @param $strIsoFormat
     * @param $strCode
     * @return void
     */
    protected static function findDelimiter($strIsoFormat, $strCode): array
    {
        //*** possible delimiters.
        $arrDelimiters = [" ", "-", "|", ";", ","];

        foreach ($arrDelimiters as $strDelimiter) {

            //*** 1. Check if the delimiter is before and after the code.
            if (strpos($strIsoFormat, $strDelimiter . $strCode . $strDelimiter) !== false) {
                return [1, $strDelimiter];
            }

            //*** 2. Check if the delimiter is before the code.
            if (strpos($strIsoFormat, $strDelimiter . $strCode) !== false) {
                return [2, $strDelimiter];
            }

            //*** 3. Check if the delimiter is after the code.
            if (strpos($strIsoFormat, $strCode . $strDelimiter) !== false) {
                return [3, $strDelimiter];
            }
        }

        //*** 4 There was no delimiter found.
        return [4, ''];
    }

    /**
     * Adds delimiter to array values.
     *
     * @param $arrValues
     * @param $intPosition
     * @param $strDelimiter
     * @return array
     */
    protected static function extendArrayValues($arrValues, $intPosition, $strDelimiter): array
    {
        $arrReturn = [];
        foreach ($arrValues as $strValue) {
            switch ($intPosition) {
                case 1:
                    //*** 1. before and after.
                    $arrReturn[] = $strDelimiter . $strValue . $strDelimiter;

                    break;
                case 2:
                    //*** 2. before.
                    $arrReturn[] = $strDelimiter . $strValue;

                    break;
                case 3:
                    //*** 3 after.
                    $arrReturn[] = $strValue . $strDelimiter;

                    break;
                default:
                    $arrReturn[] = $strValue;
            }
        }

        return $arrReturn;
    }

    /**
     * Determine if a specific age falls within a specific year.
     *
     * @param \DateTime $objBirth
     * @param float $fltAge
     * @param int|null $intYear
     * @return bool
     * @throws \Exception
     */
    public static function ageIsWithinYear(\DateTime $objBirth, $fltAge, ?int $intYear = null): bool
    {
        if (is_null($intYear)) {
            $intYear = (int) date("Y");
        }

        $intYears = $fltAge;
        $intMonths = 0;

        if (is_float($fltAge)) {
            $intYears = floor($fltAge);
            $fltMonths = $fltAge - $intYears;
            if ($fltMonths > 0) {
                $intMonths = round(12 / (1 / $fltMonths));
            }
        }

        $objInterval = new \DateInterval("P{$intYears}Y{$intMonths}M");
        $objBirth->add($objInterval);

        return ((int) $objBirth->format("Y") === $intYear);
    }

    /**
     * Determine how many seconds a progress takes until it's at 100% using a given start DateTime
     * and progress until now.
     *
     * @param \DateTime $dtStartDate
     * @param int $intProgress
     * @return int
     * @throws \Exception
     */
    public static function secondsUntilDone(\DateTime $dtStartDate, int $intProgress): int
    {
        $dtNow = new \DateTime();
        $dtDifference = $dtStartDate->diff($dtNow);

        $intSecondsSince = (($dtDifference->h * 86400) + ($dtDifference->h * 3600)
            + ($dtDifference->i * 60) + $dtDifference->s);

        return round(($intSecondsSince * (100 / $intProgress)) - $intSecondsSince);
    }

    /**
     * Remove time (00:00 or 00:00:00) from a date string.
     *
     * @param string $strDate
     * @return string
     */
    public static function removeTimeInfo(string $strDate): string
    {
        $strDate = trim(preg_replace("/([0-9]{2}):([0-9]{2}):([0-9]{2})/", "", $strDate));
        $strDate = trim(preg_replace("/([0-9]{2}):([0-9]{2})/", "", $strDate));

        return $strDate;
    }

    /**
     * Changes time zone without changing the time.
     *
     * @param \DateTimeInterface $objDateTime
     * @param string $strTimeZone
     * @return Carbon
     */
    public static function shiftTimeZone(\DateTimeInterface $objDateTime, string $strTimeZone): Carbon
    {
        return new Carbon($objDateTime->format('Y-m-d H:i:s'), $strTimeZone);
    }
}
