<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_name',
        'slug',
        'contact_name',
        'contact_email',
        'contact_phone',
        'website_url',
        'city',
        'province',
        'country',
        'address',
        'services',
        'status',
    ];

    protected $casts = [
        'services' => 'array',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(MonthlyReport::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
