<?php

namespace App\DTOs;

class StoreGuestDonationDTO
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $gender,
        public readonly ?string $occupation,
        public readonly string $email,
        public readonly ?string $phone,
        public readonly string $donation_tier,
        public readonly int $amount,
        public readonly string $frequency
    ) {}
}
