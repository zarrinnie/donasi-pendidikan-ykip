<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DonationPackage;

class DonationPackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Small',
                'amount' => 50000,
                'description' => 'Regular',
                'icon' => '☕', // Or a coffee cup icon
                'is_custom' => false,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Medium',
                'amount' => 75000,
                'description' => 'Medium',
                'icon' => '🧋', // Coffee beans or medium cup
                'is_custom' => false,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Large',
                'amount' => 100000,
                'description' => 'Large',
                'icon' => '🍰', // Large coffee or meal
                'is_custom' => false,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Custom',
                'amount' => 0,
                'description' => 'Custom',
                'icon' => '💵', // Cash or custom icon
                'is_custom' => true,
                'is_active' => true,
                'sort_order' => 4,
            ]
        ];

        foreach ($packages as $package) {
            DonationPackage::create($package);
        }
    }
}
