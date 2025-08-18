<?php

namespace App\Classes;

use Carbon\Carbon;
use DateTimeInterface;

class Year
{
    public static function ringDateToString(string $strIsoFormat, DateTimeInterface $objDate = null): string
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

    public static function addTwoYears(DateTimeInterface $objDate): DateTimeInterface
    {
        return $objDate->add(new \DateInterval('P2Y'));
    }
}
