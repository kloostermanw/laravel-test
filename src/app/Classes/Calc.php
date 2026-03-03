<?php

namespace App\Classes;


class Calc
{
    public static function add(float $value1, float $value2): float
    {
        return $value1 + $value2;
    }

    public static function subtract(float $value1, float $value2): float
    {
        return $value1 - $value2;
    }
}
