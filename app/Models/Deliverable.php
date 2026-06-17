<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deliverable extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'summary',
        'file_path',
        'external_url',
        'status',
        'is_client_visible',
        'approved_at',
    ];

    protected $casts = [
        'is_client_visible' => 'boolean',
        'approved_at' => 'datetime',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
