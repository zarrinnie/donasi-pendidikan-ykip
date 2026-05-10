<?php

namespace App\Actions;

use App\DTOs\StoreGuestDonationDTO;
use App\Models\Donor;
use App\Models\Donation;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProcessGuestDonationAction
{
    public function execute(StoreGuestDonationDTO $dto): Donation
    {
        // Find or create donor by email
        $donor = Donor::firstOrCreate(
            ['email' => $dto->email],
            [
                'name' => $dto->name,
                'gender' => $dto->gender,
                'occupation' => $dto->occupation,
                'phone' => $dto->phone,
            ]
        );

        // Update details if donor exists but provided new info
        if (!$donor->wasRecentlyCreated) {
            $donor->update([
                'name' => $dto->name,
                'gender' => $dto->gender,
                'occupation' => $dto->occupation,
                'phone' => $dto->phone,
            ]);
        }

        // Calculate next reminder date based on frequency
        $nextReminderDate = null;
        if ($dto->frequency === '3 Bulan') {
            $nextReminderDate = Carbon::now()->addMonths(3);
        } elseif ($dto->frequency === '6 Bulan') {
            $nextReminderDate = Carbon::now()->addMonths(6);
        } elseif ($dto->frequency === '1 Tahun') {
            $nextReminderDate = Carbon::now()->addYear();
        }

        // Create donation
        return $donor->donations()->create([
            'donation_tier' => $dto->donation_tier,
            'amount' => $dto->amount,
            'frequency' => $dto->frequency,
            'payment_status' => 'Pending',
            'tracking_code' => Str::random(10),
            'receipt_number' => 'REC-' . strtoupper(Str::random(6)),
            'next_reminder_date' => $nextReminderDate,
        ]);
    }
}
