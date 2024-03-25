<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Job extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'link',
        'slug',
        'description',
        'proof_details',
        'image',
        'num_of_worker',
        'per_worker_amount',
        'num_of_screenshot',
        'estimated_day',
        'estimated_cost',
        'status',
        'is_approved',
        'is_featured'
    ];
    protected $appends = [
        'completed_percentage',
        'is_reportable'
    ];
    protected $with = [
        'steps',
        'category',
        'user',
    ];
    protected $withCount = [
        'countableWorks',
        'reportedWorks'
    ];

    public function getCompletedPercentageAttribute()
    {
        if ($this->attributes['num_of_worker'] != 0) {
            return ($this->countable_works_count / $this->attributes['num_of_worker']) * 100;
        }

        return 0;
    }

    public function getIsReportableAttribute()
    {

        if ($this->num_of_worker == 0 || is_null($this->num_of_worker)) {
            return false;
        }
        if ($this->reported_works_count >= floor($this->num_of_worker / 5)) {
            return false;
        }

        return true;
    }

    public function steps(): HasMany
    {
        return $this->hasMany(JobStep::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }

    public function countableWorks(): HasMany
    {
        return $this->hasMany(Work::class)->whereIn('status', ['pending', 'completed']);
    }

    public function reportedWorks(): HasMany
    {
        return $this->hasMany(Work::class, 'job_id')->whereHas('report');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title']
            ]
        ];
    }

    protected static function boot()
    {
        parent::boot();

        self::created(function ($job) {
            Cache::forget('pending_jobs_count');
            Cache::forget('total_jobs_count');
        });

        self::updated(function ($job) {
            Cache::forget('total_jobs_count');
            Cache::forget('pending_jobs_count');
        });
    }
}
