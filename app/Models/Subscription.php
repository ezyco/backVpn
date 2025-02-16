<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public const title      = 'title';
    public const expiration = 'expiration';
    public const price      = 'price';
    public const size       = 'size';
    protected $fillable = [
        self::title,
        self::expiration,
        self::price,
        self::size,
    ];
}
