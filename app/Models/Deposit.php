<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'method',
        'amount',
        'transaction_id',
        'phone',
        'status'
    ];
    protected $with = [
        'user'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::created(function ($deposit) {
            Cache::forget('pending_deposits_count');
            Cache::forget('total_deposits_amount');
        });

        self::updated(function ($deposit) {
            Cache::forget('pending_deposits_count');
            Cache::forget('total_deposits_amount');
        });
    }
}
