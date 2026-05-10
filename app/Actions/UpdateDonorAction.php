<?php

namespace App\Actions;

use App\Models\Donor;

class UpdateDonorAction
{
    public function execute(Donor $donor, array $data): Donor
    {
        $donor->update($data);
        return $donor;
    }
}
