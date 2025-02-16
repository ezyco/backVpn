<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    public const user_id         = 'user_id';
    public const subscription_id = 'subscription_id';
    public const size            = 'size';
    protected $fillable = [
        self::user_id,
        self::subscription_id,
        self::size,
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', self::user_id);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'id', self::subscription_id);
    }
}
