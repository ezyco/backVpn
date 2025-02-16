<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    public const country     = 'country';
    public const location    = 'location';
    public const countryFlag = 'countryFlag';
    public const active      = 'active';
    public const special     = 'special';
    public const configFile  = 'configFile';
    public const type        = 'type';
    protected $fillable = [
        self::country,
        self::location,
        self::countryFlag,
        self::active,
        self::special,
        self::configFile,
        self::type,
    ];
}
