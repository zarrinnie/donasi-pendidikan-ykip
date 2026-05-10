<?php

namespace App\Actions;

use App\Models\Donation;

class DeleteDonationAction
{
    public function execute(Donation $donation): bool
    {
        return $donation->delete();
    }
}
