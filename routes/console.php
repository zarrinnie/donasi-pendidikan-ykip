<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

use App\Models\Donation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;

Schedule::call(function () {
    $donations = Donation::whereNotNull('next_reminder_date')
                         ->where('next_reminder_date', '<=', now()->toDateString())
                         ->with('donor')
                         ->get();

    foreach ($donations as $donation) {
        // Send email logic using the reminder mailer (mock for now)
        Log::info("Sending automated reminder to {$donation->donor->email}");
        
        /* 
        Mail::mailer('reminder')
            ->to($donation->donor->email)
            ->send(new \App\Mail\ReminderEmail($donation));
        */
        
        // Update next reminder date if recurring, or null it
        // For simplicity, we just set it to null after sending one reminder
        $donation->update(['next_reminder_date' => null]);
    }
})->dailyAt('08:00');
