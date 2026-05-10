<?php

namespace App\Actions;

class GenerateQrisCodeAction
{
    public function execute(int $amount): string
    {
        // In a real application, this would call a payment gateway API (e.g. Midtrans, Xendit)
        // For this task, we return a mock QRIS code payload/URL.
        return 'MOCK_QRIS_PAYLOAD_FOR_AMOUNT_' . $amount;
    }
}
