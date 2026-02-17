<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookieConsent extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'consent_given',
        'categories',
        'consent_id'
    ];

    protected $casts = [
        'consent_given' => 'boolean',
        'categories' => 'array'
    ];

    /**
     * Generate unique consent ID
     */
    public static function generateConsentId(): string
    {
        return uniqid('consent_', true) . '_' . bin2hex(random_bytes(16));
    }
}