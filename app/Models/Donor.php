<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'gender', 'occupation', 'email', 'phone'])]
class Donor extends Model
{
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }
}
