<?php

namespace App\Actions;

use App\Models\Donation;

class ToggleWelcomeEmailStatusAction
{
    /**
     * Toggle the welcome email sent status for a donation.
     *
     * @param int $donationId
     * @return void
     */
    public function execute(int $donationId): void
    {
        $donation = Donation::findOrFail($donationId);
        
        $donation->update([
            'is_welcome_email_sent' => !$donation->is_welcome_email_sent
        ]);
    }
}
