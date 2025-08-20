<?php

namespace App\Classes;

class Arr
{
    public static function reverse(array $array)
    {
        return array_reverse($array);
    }

    public static function keys(array $array)
    {
        return array_keys($array);
    }

    public static function values(array $array)
    {
        return array_values($array);
    }
}
