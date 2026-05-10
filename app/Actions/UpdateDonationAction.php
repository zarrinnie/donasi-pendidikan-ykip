<?php

namespace App\Actions;

use App\Models\Donation;

class UpdateDonationAction
{
    public function execute(Donation $donation, array $data): Donation
    {
        $donation->update($data);
        return $donation;
    }
}
