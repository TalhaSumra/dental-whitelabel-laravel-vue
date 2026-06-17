<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_name',
        'support_email',
        'support_phone',
        'website_url',
        'brand_color',
        'logo_path',
        'client_report_footer',
    ];

    public static function current(): self
    {
        return self::query()->firstOrCreate([], [
            'agency_name' => 'Dental Growth Media Canada',
            'brand_color' => '#0f766e',
        ]);
    }
}
