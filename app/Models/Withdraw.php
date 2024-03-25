<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'method',
        'amount',
        'account_number',
        'status',
    ];
    protected $with = [
        'user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::created(function ($withdraw) {
            Cache::forget('pending_withdraws_count');
            Cache::forget('total_withdraws_amount');
        });

        self::updated(function ($withdraw) {
            Cache::forget('pending_withdraws_count');
            Cache::forget('total_withdraws_amount');
        });
    }
}
