<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'service_package_id',
        'owner_user_id',
        'name',
        'type',
        'status',
        'start_date',
        'due_date',
        'client_price_cad',
        'white_label_cost_cad',
        'scope',
        'internal_notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
        'internal_notes' => 'array',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(ServicePackage::class, 'service_package_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function deliverables(): HasMany
    {
        return $this->hasMany(Deliverable::class);
    }

    public function grossMarginCad(): int
    {
        return max(0, (int) $this->client_price_cad - (int) $this->white_label_cost_cad);
    }
}
