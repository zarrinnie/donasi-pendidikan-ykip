<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Donor;
use App\Models\Donation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@o.org',
            'password' => Hash::make('password'),
            'role' => 'Super Admin',
        ]);

        $this->call([
            DonationPackageSeeder::class,
        ]);

        $donor = Donor::create([
            'name' => 'Zarrin Nadhira',
            'email' => 'zarrin@example.com',
            'gender' => 'Perempuan',
            'occupation' => 'Software Engineer',
            'phone' => '081234567890'
        ]);

        Donation::create([
            'donor_id' => $donor->id,
            'donation_tier' => 'Regular',
            'amount' => 50000,
            'frequency' => '3 Bulan',
            'payment_status' => 'Success',
            'tracking_code' => Str::random(10),
            'is_welcome_email_sent' => false,
            'next_reminder_date' => Carbon::now()->addMonths(3),
            'receipt_number' => 'REC-0001'
        ]);
    }
}
