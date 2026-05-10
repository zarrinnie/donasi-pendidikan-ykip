<?php

namespace App\Actions;

use App\Models\Donor;

class DeleteDonorAction
{
    public function execute(Donor $donor): bool
    {
        return $donor->delete();
    }
}
