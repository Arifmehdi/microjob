<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'details',
        'work_id',
        'status'
    ];

    public function work(): BelongsTo
    {
        return $this->belongsTo(Work::class, 'work_id');
    }
}
