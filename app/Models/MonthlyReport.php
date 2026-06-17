<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'project_id',
        'month',
        'year',
        'status',
        'metrics',
        'completed_work',
        'next_month_plan',
        'summary',
        'published_at',
    ];

    protected $casts = [
        'metrics' => 'array',
        'completed_work' => 'array',
        'next_month_plan' => 'array',
        'published_at' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
