<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'details',
        'is_read',
        'action_link',
    ];

    protected static function boot()
    {
        parent::boot();

        self::created(function ($notification) {
            Cache::forget('total_unread_notification' . $notification->user_id);
        });

        self::updated(function ($notification) {
            Cache::forget('total_unread_notification' . $notification->user_id);
        });

    }
}
