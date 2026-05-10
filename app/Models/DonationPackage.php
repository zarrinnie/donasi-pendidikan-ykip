<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'description',
        'icon',
        'is_custom',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_custom' => 'boolean',
        'is_active' => 'boolean',
    ];
}
