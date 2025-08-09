<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aico extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'wattage',
    ];
}
