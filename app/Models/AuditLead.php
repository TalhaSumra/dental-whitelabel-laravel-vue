<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_name',
        'contact_name',
        'email',
        'phone',
        'website_url',
        'city',
        'province',
        'message',
        'status',
    ];
}
