<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'donor_id',
    'donation_tier',
    'amount',
    'frequency',
    'payment_status',
    'tracking_code',
    'is_welcome_email_sent',
    'next_reminder_date',
    'receipt_number'
])]
class Donation extends Model
{
    protected function casts(): array
    {
        return [
            'is_welcome_email_sent' => 'boolean',
            'next_reminder_date' => 'date',
        ];
    }

    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }
}
