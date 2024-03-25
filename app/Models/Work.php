<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'user_id',
        'proof_details',
        'per_worker_amount',
        'screenshots',
        'status',
    ];
    protected $casts = [
        'screenshots' => 'array'
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function notes()
    {
        return $this->hasMany(WorkNote::class);
    }

    public function report(): HasOne
    {
        return $this->hasOne(Report::class, 'work_id');
    }
}
